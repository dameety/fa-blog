<template>
    <div class="uk-width-large uk-align-center">

        <form class="uk-grid-small uk-grid"
              @submit.prevent="joinNewsletter">

            <div class="uk-width-3-4@s">
                <input class="uk-input" v-model="newsletter.email" type="email">
            </div>

            <div class="uk-width-1-4@s">
                <button type="submit" class="uk-button uk-button-primary">
                    Submit
                </button>
            </div>
        </form>

    </div>
</template>

<script>
    export default {
        data () {
            return {
                newsletter: {
                    email: null
                }
            }
        },

        methods: {
            joinNewsletter () {
                axios.post('/ajax/subscribers', this.newsletter)
                    .then((resp) => {
                        this.$toastr.defaultCloseOnHover = false
                        this.$toastr.s(resp.data.message)
                        this.newsletter.email = ''
                    })
                    .catch( errors => {
                        console.log(errors)

                        if(errors.response.data.message) {
                            this.$toastr.defaultCloseOnHover = false
                            this.$toastr.e(errors.response.data.message)
                        }

                        this.formErrors = errors.response.data.errors;
                    });
            }
        }
    }
</script>

<style scoped>

</style>