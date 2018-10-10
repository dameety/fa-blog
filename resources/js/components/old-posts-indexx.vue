<template>
    <div>
        <div class="card">

            <div class="card-header">
                <h3 class="card-title"> Post </h3>
                <div class="card-options">
                    <form class="form-row">
                        <div v-if="checkedPosts.length > 0" class="input-group col-md-3 d-flex justify-content-end">
                            <a @click.prevent="bulkDelete()" class="btn btn-danger btn-sm">Delete</a>
                        </div>
                        <div class="input-group col-md-6">
                            <input type="text" class="form-control form-control-sm"
                                   v-model="tableData.search" placeholder="Search Table"
                                   @input="search">
                        </div>
                        <div class="input-group col-md-3">
                            <select v-model="tableData.length" @change="getPosts()" class="form-control form-control-sm">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
                    <tbody slot="table_body">
                        <tr v-for="post in posts" :key="post.id">
                            <td>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" v-model="checkedPosts" :value="post.id" aria-label="select">
                                    <span class="custom-control-label"></span>
                                </label>
                            </td>
                            <td>{{post.title}}</td>

                            <td>
                                <template v-for="(category, index) in post.categories">
                                    {{category.name}}
                                    <template v-if="index === 0"> &</template>
                                </template>
                            </td>

                            <td>
                                <div class="small text-muted">{{post.author.email}}</div>
                            </td>

                            <td class="text-center">
                                {{post.status}}
                            </td>

                            <td class="text-center">
                                <div class="item-action dropdown">
                                    <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a :href="editPost(post)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i>
                                            Edit
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a :href="viewPost(post)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i>
                                            View
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a @click.prevent="deletePost(post)" class="dropdown-item"><i class="dropdown-icon fe fe-link"></i>
                                            Delete
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </datatable>
            </div>
        </div>

        <pagination :pagination="pagination"
            @prev="getPosts(pagination.prevPageUrl)"
            @next="getPosts(pagination.nextPageUrl)">
        </pagination>
    </div>
</template>

<script>
    import datatable from '../modules/datatable.vue';
    import pagination from '../modules/pagination.vue';

    export default {
        name: "posts-index",

        components: {
            datatable, pagination
        },

        created() {
            this.getPosts();
        },

        data() {
            let sortOrders = {};
            let columns = [
                {label: 'Title', name: 'title', class: '', orderable: true},
                {label: 'Categories', name: 'category_id', class: '', orderable: true},
                {label: 'Author', name: 'author_id', class: '', orderable: false},
                {label: 'Status', name: 'status', class:'text-center', orderable: true}
            ];
            columns.forEach((column) => {
                sortOrders[column.name] = -1;
            });
            return {
                posts: [],
                checkedPosts: [],

                columns: columns,
                sortKey: 'status',
                sortOrders: sortOrders,
                tableData: {
                    draw: 0,
                    length: 10,
                    search: '',
                    column: 0,
                    dir: 'desc',
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
                },
            }
        },

        methods: {
            getPosts(url = '/ajax/posts') {
                this.tableData.draw++;
                axios.get(url, {params: this.tableData})
                    .then(resp => {
                        let data = resp.data
                        if (this.tableData.draw == data.data.draw) {
                            this.posts = data.data.posts.data;
                            console.log('posts is:', this.posts)
                            this.configPagination(data.data.posts);
                            console.log(data.data.posts)
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
            sortBy(key) {
                this.sortKey = key;
                this.sortOrders[key] = this.sortOrders[key] * -1;
                this.tableData.column = this.getIndex(this.columns, 'name', key);
                this.tableData.dir = this.sortOrders[key] === 1 ? 'asc' : 'desc';
                this.getPosts();
            },
            getIndex(array, key, value) {
                return array.findIndex(i => i[key] == value)
            },
            search: _.debounce(function (e) {
                this.getPosts()
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

                        axios.post('/ajax/posts/bulk-delete', {post_ids: this.checkedPosts})
                            .then(resp => {

                                this.checkedPosts.forEach(id => {
                                    let index = this.posts.findIndex(post => post.id === id);
                                    this.posts.splice(index, 1);
                                })

                                this.checkedPosts = []

                                this.$toastr.defaultCloseOnHover = false
                                this.$toastr.s(resp.data.message)

                            })
                            .catch(errors => {
                                console.log(errors);
                            });
                    }
                })
            },
            viewPost(post) {
                return `/post/${post.slug}`
            },
            editPost(post) {
                return `/backend/posts/${post.slug}/edit`
            },
            deletePost(post) {
                console.log(post.id)

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

                    axios.delete(`/ajax/posts/${post.id}`)
                        .then(resp => {

                            let index = this.posts.findIndex(post => post.id === post.id);
                            this.posts.splice(index, 1);

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