<template>
    <form class="row" @submit.prevent="save()">

        <div class="col-lg-8">
            <div class="card" >
                <div class="card-header">
                    <h3 class="card-title">Update Profile</h3>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <label for="email" class="form-label">Contact Email</label>
                        <input class="form-control" id="email" v-model="setting.contact_email" required/>
                        <small class="form-text text-danger" role="alert" v-if="formErrors.email">
                            {{formErrors.email[0]}}
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="about" class="form-label">About</label>
                        <textarea id="about" v-model="setting.about" class="form-control" rows="4"></textarea>
                        <small class="form-text text-danger" role="alert" v-if="formErrors.about">
                            {{formErrors.about[0]}}
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="google_analytics_code" class="form-label">Google_analytics_code</label>
                        <textarea ref="google_analytics_code" id="google_analytics_code" v-model="setting.google_analytics_code" class="form-control" rows="4"></textarea>
                        <small class="form-text text-danger" role="alert" v-if="formErrors.google_analytics_code">
                            {{formErrors.google_analytics_code[0]}}
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="facebook" class="form-label">Facebook</label>
                        <input class="form-control" id="facebook" v-model="setting.facebook"/>
                        <small class="form-text text-danger" role="alert" v-if="formErrors.facebbok">
                            {{formErrors.facebook[0]}}
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="twitter" class="form-label">Twitter</label>
                        <input class="form-control" id="twitter" v-model="setting.twitter"/>
                        <small class="form-text text-danger" role="alert" v-if="formErrors.twitter">
                            {{formErrors.twitter[0]}}
                        </small>
                    </div>

                </div>

                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                </div>
            </div>
        </div>

        <div class="col-lg-4">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">App Avatar</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center mb-5">

                        <img class="app_avatar" :src="current_avatar"
                             alt="app about iamge" v-if="!setting.app_avatar">

                        <img class="app_avatar" :src="setting.app_avatar"
                             alt="app about iamge" v-if="setting.app_avatar">
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
    export default {
        name: "setting-edit",

        props: [
            'about_prop', 'app_avatar_url', 'app_email_prop', 'facebook_prop', 'twitter_prop', 'google_analytics_code'
        ],

        data () {
            return {
                setting: {
                    app_avatar: null,
                    about: this.about_prop,
                    twitter: this.twitter_prop,
                    facebook: this.facebook_prop,
                    contact_email: this.app_email_prop,
                    google_analytics_code: this.google_analytics_code
                },
                current_avatar: this.app_avatar_url,
                formErrors: []
            }
        },


        methods: {
            save () {
                this.setting.google_analytics_code = tinymce.get('google_analytics_code').getContent()
                let data = this.setting

                if(!this.setting.app_avatar) delete this.setting.app_avatar

                axios.post('/ajax/setting', data)
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
                    vm.setting.app_avatar = e.target.result;
                };
                reader.readAsDataURL(file);
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
    .app_avatar {
        height: 200px;
        width: auto;
    }
</style>