<template>
    <form class="row" @submit.prevent="storePost()">

        <div class="col-lg-8">
            <div class="card" >
                <div class="card-header">
                    <h3 class="card-title" v-if="type === 'new'">
                        New Post
                    </h3>

                    <h3 class="card-title" v-if="type === 'edit'">
                        Edit Post
                    </h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="title" class="form-label">Title</label>
                        <input class="form-control" id="title" v-model="post.title" required/>
                        <small class="form-text text-danger" role="alert" v-if="formErrors.title">
                            {{formErrors.title[0]}}
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="body" class="form-label">Body</label>
                        <textarea ref="body" id="body" v-model="post.body" class="form-control"></textarea>
                        <small class="form-text text-danger" role="alert" v-if="formErrors.body">
                            {{formErrors.body[0]}}
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="excerpt" class="form-label">Excerpt</label>
                        <textarea id="excerpt" v-model="post.excerpt" class="form-control" rows="4" required></textarea>
                        <small class="form-text text-danger" role="alert" v-if="formErrors.excerpt">
                            {{formErrors.excerpt[0]}}
                        </small>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary" v-if="type === 'new'">
                        Save Post
                    </button>
                    <button type="submit" class="btn btn-primary" v-if="type === 'edit'">
                        Update
                    </button>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Status
                    </h3>
                </div>
                <div class="card-body">
                    <v-select
                        id="status_select"
                        :close-on-select=true
                        v-model="post.status"
                        :options="statusOptions">
                    </v-select>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Post Image</h3>
                </div>
                <div class="card-body">
                    <div>
                        <img id="post_image" :src="post.image" alt="new post image" v-if="post.image">
                        <img id="current_image" :src="current_image" alt="current post image"
                             v-if="!post.image">
                    </div>

                    <!--the two blocks below cos of required image field -->
                    <div class="custom-file" v-if="type === 'new'">
                        <input type="file" class="custom-file-input"
                               accept="image/*" v-on:change="onFileChange"
                               required>
                        <label class="custom-file-label">Choose file</label>
                    </div>

                    <div class="custom-file" v-if="type === 'edit'">
                        <input type="file" class="custom-file-input"
                               accept="image/*" v-on:change="onFileChange">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Categories</h3>
                </div>
                <div class="card-body">
                    <tags-input element-id="tags"
                                v-model="post.categories"
                                :existing-tags="categoryOptions"
                                :typeahead="true"></tags-input>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tags</h3>
                </div>
                <div class="card-body">
                    <tags-input element-id="tags"
                                v-model="post.tags"
                                :existing-tags="tagOptions"
                                :typeahead="true"></tags-input>
                </div>
            </div>
        </div>

    </form>
</template>

<script>
    import vSelect from "vue-select"
    import VueTagsInput from '@johmun/vue-tags-input';

    export default {
        name: "new-post",

        components: {
            vSelect,
            VueTagsInput
        },

        props: {
            type: {
                default: 'new'
            },
            categories_prop: {
            },
            post_prop: {
            },
            image_prop: {
            }
        },

        data () {
            return {
                post: {
                    body: null,
                    title: 'ssoso sososos ososos ',
                    image: '',
                    status: 'draft',
                    excerpt: 'ssosos sososos ososos isisis isisis isisis isisis ',
                    categories: [],
                    tags: [],
                    slug: ''
                },
                formErrors: [],
                current_image: '',

                tagOptions: {},
                categoryOptions: {},
                statusOptions: ['published', 'draft']
            }
        },

        created() {
            this.getCategories()
            this.getTags()
        },

        mounted () {
            if(this.type === 'edit') {
                let p = JSON.parse(this.post_prop)
                this.post.slug = p.slug
                this.post.body = p.body
                this.post.title = p.title
                this.post.status = p.status
                this.post.excerpt = p.excerpt
                this.current_image = this.image_prop
                this.post.categories = JSON.parse(this.categories_prop)
                console.log('post prop is:', this.post)
            }
        },

        methods: {
            getCategories() {
                axios.get(`/ajax/all/categories`)
                    .then((response) => {
                        this.categoryOptions = response.data.data
                        console.log(response.data)
                    });
            },

            getTags() {
                axios.get(`/ajax/all/tags`)
                    .then((response) => {
                        console.log(response.data)

                        let data = response.data.data.split(",")
                        let tempTagOptions = []

                        data.forEach(tag => {

                            this.tagOptions["tag"] = tag
                        })

                    });
            },

            storePost () {
                this.post.body = tinymce.get('body').getContent();
                let details = this.post

                if(this.type !== 'edit') {

                    return this.savePost($details)
                }

                return this.updatePost(details)
            },

            savePost(details) {
                axios.post('/ajax/posts', details)
                    .then((resp) => {
                        this.$toastr.defaultCloseOnHover = false
                        this.$toastr.s(resp.data.message)
                        this.resetInputs()
                    })
                    .catch( errors => {
                        console.log(errors)

                        if(errors.response.data.message) {
                            this.$toastr.defaultCloseOnHover = false
                            this.$toastr.e(errors.response.data.message)
                        }

                        this.formErrors = errors.response.data.errors;
                    });
            },

            updatePost(details) {
                if(!this.post.image) delete this.post.image

                axios.patch(`/ajax/posts/${this.post.slug}`, details)
                    .then((resp) => {
                        this.$toastr.defaultCloseOnHover = false
                        this.$toastr.s(resp.data.message)
                    })
                    .catch( errors => {
                        console.log(errors)

                        if(errors.response.data.message) {
                            this.$toastr.defaultCloseOnHover = false
                            this.$toastr.e(errors.response.data.message)
                        }

                        this.formErrors = errors.response.data.errors;
                    });
            },

            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length) return;

                this.createImage(files[0]);
            },

            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.post.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },

            resetInputs () {
                this.post = {}
            }
        }
    }
</script>

<style scoped>
    #status_select {
        width: 100%;
    }
    #post_image, #current_image {
        margin-bottom: 15px;
    }

</style>