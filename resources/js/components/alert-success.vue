<template>
</template>

<script>
    export default {
        name: "alert-success",

        props: {
            message: {
                type: String
            },
        },

        mounted() {
            this.showAlert()
        },

        methods: {
            showAlert() {
            //     this.$swal({
            //         type: 'success',
            //         title: 'Success...',
            //         text: this.message
            //     })
                this.$toastr.defaultCloseOnHover = false
                this.$toastr.s(this.message)
            }

        }
    }
</script>

<style scoped>

</style>