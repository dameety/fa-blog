<template>
    <div>

        <datatable :columns="columns" model_name="posts">
            <tbody slot="table_body" slot-scope="{data, checkedItem, editItem, viewItem, deleteItem, addToCheckedItemList}">
                <tr v-for="post in data" :key="post.id">
                    <td>
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input"
                               @change="addToCheckedItemList(post.id)"
                               :value="post.id" aria-label="select">
                            <span class="custom-control-label"></span>
                        </label>
                    </td>

                    <td>
                        {{post.title}}
                        <div>
                            <button class="btn btn-outline-primary btn-sm"
                                v-if="!post.is_featured"
                                @click.prevent="addToFeaturedPosts(post)">
                                feature
                            </button>
                            <button class="btn btn-outline-primary btn-sm"
                                v-if="post.is_featured"
                                @click.prevent="removeFromFeaturedPosts(post)">
                                unfeature
                            </button>

                            <button class="btn btn-outline-primary btn-sm"
                                v-if="!post.is_slidable"
                                @click.prevent="updateSliderStatus(post)">
                                add to slider
                            </button>
                            <button class="btn btn-outline-primary btn-sm"
                                v-if="post.is_slidable"
                                @click.prevent="updateSliderStatus(post)">
                                remove from slider
                            </button>
                        </div>
                    </td>

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
                                <a :href="editItem(post)" class="dropdown-item">
                                    <i class="dropdown-icon fe fe-edit-2"></i>
                                    Edit
                                </a>
                                <div class="dropdown-divider"></div>
                                <a :href="viewItem(post)" class="dropdown-item">
                                    <i class="dropdown-icon fe fe-edit-2"></i>
                                    View
                                </a>
                                <div class="dropdown-divider"></div>
                                <a @click.prevent="deleteItem(post)" class="dropdown-item">
                                    <i class="dropdown-icon fe fe-link"></i>
                                    Delete
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </datatable>

    </div>
</template>

<script>
    import datatable from '../modules/mega-datatable.vue'

    export default {
        name: "posts-index",

        components: {
            datatable
        },

        data () {
            let columns = [
                {label: 'Title', name: 'title', class: '', sortable: true},
                {label: 'Categories', name: 'category_id', class: '', sortable: true},
                {label: 'Author', name: 'author_id', class: '', sortable: false},
                {label: 'Status', name: 'status', class:'text-center', sortable: true}
            ];
            return {
                columns: columns
            }
        },

        methods: {
            addToFeaturedPosts (post) {
                axios.post(`/ajax/posts/${post.id}/featured`)
                    .then((resp) => {
                        console.log(resp.data)
                        window.location.reload()
                    })
                    .catch(err => {
                        this.$toastr.defaultCloseOnHover = false
                        this.$toastr.e(err.response.data.message)
                    })
            },

            removeFromFeaturedPosts (post) {
                axios.post(`/ajax/posts/${post.id}/unfeature`)
                    .then((resp) => {
                        console.log(resp.data)
                        window.location.reload()
                    })
                    .catch(err => {
                        this.$toastr.defaultCloseOnHover = false
                        this.$toastr.e(err.response.data.message)
                    })
            },

            updateSliderStatus (post) {
                axios.post(`/ajax/posts/${post.id}/slidable`)
                    .then((resp) => {
                        console.log(resp.data)
                        window.location.reload()
                    })
                    .catch(err => {
                        this.$toastr.defaultCloseOnHover = false
                        this.$toastr.e(err.response.data.message)
                    })
            }
        }
    }
</script>

