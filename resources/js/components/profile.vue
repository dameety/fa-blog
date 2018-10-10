<template>
    <form class="row" @submit.prevent="storeUser()">

        <div class="col-lg-8">
            <div class="card" >
                <div class="card-header">
                    <h3 class="card-title">Update Profile</h3>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="first_name" class="form-label">First name</label>
                        <input class="form-control" id="first_name" v-model="user.first_name" required/>
                        <small class="form-text text-danger" role="alert" v-if="formErrors.first_name">
                            {{formErrors.first_name[0]}}
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="last_name" class="form-label">Last name</label>
                        <input class="form-control" id="last_name" v-model="user.last_name" required/>
                        <small class="form-text text-danger" role="alert" v-if="formErrors.last_name">
                            {{formErrors.last_name[0]}}
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control" id="email" v-model="user.email" required/>
                        <small class="form-text text-danger" role="alert" v-if="formErrors.email">
                            {{formErrors.email[0]}}
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea id="bio" v-model="user.bio" class="form-control" rows="4"></textarea>
                        <small class="form-text text-danger" role="alert" v-if="formErrors.bio">
                            {{formErrors.bio[0]}}
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Current Password</label>
                        <input class="form-control" id="password" v-model="user.password"/>

                        <small class="form-text" role="alert">
                            leave empty if password change not required
                        </small>

                        <small class="form-text text-danger" role="alert" v-if="formErrors.password">
                            {{formErrors.password[0]}}
                        </small>

                    </div>

                    <div class="form-group">
                        <label for="new password" class="form-label">New Password</label>
                        <input class="form-control" id="new password" v-model="user.new_password"/>

                        <small class="form-text" role="alert">
                            leave empty if password change not required
                        </small>

                        <small class="form-text text-danger" role="alert" v-if="formErrors.new_password">
                            {{formErrors.new_password[0]}}
                        </small>
                    </div>

                </div>

                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">
                        Save User
                    </button>
                </div>
            </div>
        </div>

        <div class="col-lg-4">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Avatar</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center mb-5">
                        <img id="user avatar" :src="user.avatar" alt="new user avatar" v-if="user.avatar">
                    </div>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input"
                               accept="image/*" v-on:change="onFileChange">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
            </div>

        </div>

    </form>
</template>

<script>
    import vSelect from "vue-select"

    export default {
        name: "profile",

        components: {
            vSelect
        },

        props: [
            'user_prop', 'avatar'
        ],

        data () {
            return {
                user: {
                    bio: JSON.parse(this.user_prop).bio,
                    first_name: JSON.parse(this.user_prop).first_name,
                    last_name: JSON.parse(this.user_prop).last_name,
                    email: JSON.parse(this.user_prop).email,
                    password: '',
                    new_password: '',
                    avatar: this.avatar
                },
                formErrors: []
            }
        },


        methods: {
            storeUser () {
                if(! this.user.password && !this.user.new_password) {
                    delete this.user.password
                    delete this.user.new_password
                }

                this.process();
            },

            process () {
                console.log(this.user)
                axios.post('/ajax/profile', this.user)
                    .then((resp) => {
                        this.$toastr.defaultCloseOnHover = false
                        this.$toastr.s(resp.data.message)
                    })
                    .catch( errors => {
                        console.log(errors)
                        if(errors.response.data.message) {
                            this.$toastr.defaultCloseOnHover = false
                            this.$toastr.e(errors.response.data.message)
                        } else {
                            this.formErrors = errors.response.data.errors;
                        }
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
                    vm.user.avatar = e.target.result;
                };
                reader.readAsDataURL(file);
            },

            resetInputs () {
                this.user = {}
            }
        }
    }
</script>

<style scoped>
    #category_select, #tag_select, #status_select {
        width: 100%;
    }
    #post_image {
        margin-bottom: 15px;
    }
</style>