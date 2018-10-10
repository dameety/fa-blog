<template>
    <form class="row d-flex justify-content-center"
          @submit.prevent="processForm()">

        <div class="col-lg-8">
            <div class="card" >
                <div class="card-header">
                    <h3 class="card-title" v-if="type === 'new'">
                        New Category
                    </h3>

                    <h3 class="card-title" v-if="type === 'edit'">
                        Edit Category
                    </h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input class="form-control" id="name" v-model="category.name" required/>
                        <small class="form-text text-danger" role="alert" v-if="formErrors.name">
                            {{formErrors.name[0]}}
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" v-model="category.description" class="form-control" row="8"></textarea>
                        <small class="form-text text-danger" role="alert" v-if="formErrors.description">
                            {{formErrors.description[0]}}
                        </small>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary" v-if="type === 'new'">
                        Save
                    </button>
                    <button type="submit" class="btn btn-primary" v-if="type === 'edit'">
                        Update
                    </button>
                </div>
            </div>
        </div>

    </form>
</template>

<script>
    export default {
        name: "add-edit-category",

        props: {
            type: {
                default: 'new'
            },
            category_prop: {
            }
        },

        data () {
            return {
                category: {
                    name: '',
                    slug: '',
                    description: ''
                },
                formErrors: []
            }
        },

        mounted () {
            if(this.type === 'edit') {
                let cat = JSON.parse(this.category_prop)
                this.category.name = cat.name
                this.category.description = cat.description
                this.category.slug = cat.slug
            }
        },

        methods: {
            processForm () {
                let details = this.category

                if(this.type !== 'edit') {
                    return this.save(details)
                }

                return this.update(details)
            },

            save () {
                axios.post('/ajax/categories', this.category)
                    .then((resp) => {
                        console.log(resp.data)
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

            update () {
                axios.patch(`/ajax/categories/${this.category.slug}`, this.category)
                    .then((resp) => {
                        console.log(resp.data)
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

            resetInputs () {
                this.category = {
                    name: '',
                    slug: '',
                    description: ''
                }
            }
        }
    }
</script>

<style scoped>

</style>