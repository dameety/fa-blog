<template>
    
</template>

<script>
    export default {
        name: "alert",

        props: {
            message: {
                type: String
            }
        },

        mounted() {
            this.$toastr.e(this.message);
        }
    }
</script>

<style scoped>

</style>