<template>
    <div>
        <div class="card">
            <div class="card-header">
                <!--<h3 class="card-title"> Post </h3>-->
                <div class="card-options">
                    <form class="form-row">
                        <div v-if="checkedItem.length > 0" class="input-group col-md-3 d-flex justify-content-end">
                            <a @click.prevent="bulkDelete()" class="btn btn-danger btn-sm">Delete</a>
                        </div>
                        <div class="input-group col-md-6">
                            <input type="text" class="form-control form-control-sm"
                                   v-model="tableData.search" placeholder="Search Table"
                                   @input="search">
                        </div>
                        <div class="input-group col-md-3">
                            <select v-model="tableData.length" @change="getData()" class="form-control form-control-sm">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th v-for="column in columns"
                                :key="column.name"
                                @click="sortBy(column.name)"
                                :class="
                                    sortKey === column.name
                                    ? (
                                        sortOrders[column.name] > 0
                                        ? 'fa fa-angle-down'
                                        : 'fa fa-angle-up'
                                    )
                                    : 'sorting'"
                                class="column.class"
                                :style="'cursor:pointer;'">
                                {{column.label}}
                            </th>

                            <th class="text-center">
                                <i class="icon-settings"></i>
                            </th>
                        </tr>
                    </thead>

                    <slot name="table_body" :data="data"
                          :checkedItem="checkedItem" :editItem="editItem"
                          :viewItem="viewItem" :deleteItem="deleteItem"
                          :addToCheckedItemList="addToCheckedItemList">
                    </slot>
                </table>
            </div>
        </div>

        <nav aria-label="table pagination" class="d-flex align-items-center">
            <span class="page-stats">{{pagination.from}} - {{pagination.to}} of {{pagination.total}}</span>
            <ul class="pagination justify-content-end ">
                <li class="page-item" v-if="pagination.prevPageUrl">
                    <a class="page-link" @click="getData(pagination.prevPageUrl)">
                        Previous
                    </a>
                </li>

                <li class="page-item disabled" v-else>
                    <a class="page-link" href="#" tabindex="-1">
                        Previous
                    </a>
                </li>

                <li class="page-item" v-if="pagination.nextPageUrl">
                    <a class="page-link" @click="getData(pagination.nextPageUrl)">
                        Next
                    </a>
                </li>

                <li class="page-item disabled" v-else>
                    <a class="page-link" href="#" tabindex="-1">
                        Next
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
    export default {
        props: ['columns', 'model_name'],

        data () {
            let sortOrders = {};

            this.columns.forEach((column) => {
                sortOrders[column.name] = -1;
            });
            return {
                data: [],
                checkedItem: [],

                sortKey: 'name',
                sortOrders: sortOrders,
                tableData: {
                    draw: 0,
                    length: 10,
                    search: '',
                    column: 0,
                    dir: 'desc'
                },
                pagination: {
                    lastPage: '',
                    currentPage: '',
                    total: '',
                    lastPageUrl: '',
                    nextPageUrl: '',
                    prevPageUrl: '',
                    from: '',
                    to: ''
                }
            }
        },

        created() {
            this.getData();
        },

        methods: {
            getData(url = `/ajax/${this.model_name}`) {
                this.tableData.draw++;
                axios.get(url, {params: this.tableData})
                    .then(resp => {
                        let data = resp.data
                        console.log('resp is:', resp.data)
                        if (this.tableData.draw == data.data.draw) {
                            this.data = data.data.data.data;
                            console.log('data is:', this.data)
                            this.configPagination(data.data.data);
                        }
                    })
                    .catch(errors => {
                        console.log(errors);
                    });
            },

            configPagination(data) {
                this.pagination.lastPage = data.last_page;
                this.pagination.currentPage = data.current_page;
                this.pagination.total = data.total;
                this.pagination.lastPageUrl = data.last_page_url;
                this.pagination.nextPageUrl = data.next_page_url;
                this.pagination.prevPageUrl = data.prev_page_url;
                this.pagination.from = data.from;
                this.pagination.to = data.to;
            },

            addToCheckedItemList(id) {
                // this.checkedItem.push(id)

                if(!this.checkedItem.length > 0) {
                    this.checkedItem.forEach(item => {
                        console.log('ttt')

                        console.log('item is:', item)
                        console.log('id is:', id)

                        if(item !== id) {
                            this.checkedItem.push(id)
                        }

                    })
                    console.log('checkedItem:', this.checkedItem)
                }

                // this.checkedItem.forEach(id => {
                //     let index = this.datadata.findIndex(data => data.id === id);
                //     this.data.splice(index, 1);
                // })
            },

            viewItem(item) {
                return `/backend/${this.model_name}/${item.slug}`
            },

            editItem(item) {
                return `/backend/${this.model_name}/${item.slug}/edit`
            },

            deleteItem(item) {
                console.log(item.id)

                this.$swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete(`/ajax/${this.model_name}/${item.id}`)
                            .then(resp => {

                                let index = this.data.findIndex(data => data.id === item.id);
                                this.data.splice(index, 1);

                                this.$toastr.defaultCloseOnHover = false
                                this.$toastr.s(resp.data.message)

                            })
                            .catch(errors => {
                                console.log(errors);
                            });
                    }

                })
            },

            sortBy(key) {
                this.sortKey = key;
                this.sortOrders[key] = this.sortOrders[key] * -1;
                this.tableData.column = this.getIndex(this.columns, 'name', key);
                this.tableData.dir = this.sortOrders[key] === 1 ? 'asc' : 'desc';
                this.getData();
            },

            getIndex(array, key, value) {
                return array.findIndex(i => i[key] == value)
            },

            search: _.debounce(function (e) {
                this.getData()
            }, 700),

            bulkDelete () {
                this.$swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        axios.post(`/ajax/${this.model_name}/bulk-delete`, {data_ids: this.checkedItem})
                            .then(resp => {

                                this.checkedItem.forEach(id => {
                                    let index = this.datadata.findIndex(data => data.id === id);
                                    this.data.splice(index, 1);
                                })

                                this.checkedItem = []

                                this.$toastr.defaultCloseOnHover = false
                                this.$toastr.s(resp.data.message)

                            })
                            .catch(errors => {
                                console.log(errors);
                            });
                    }
                })
            }
        }

    }
</script>