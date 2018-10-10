<template>
    <nav aria-label="table pagination" class="d-flex align-items-center">
        <span class="page-stats">{{pagination.from}} - {{pagination.to}} of {{pagination.total}}</span>

        <ul class="pagination justify-content-end ">

            <li class="page-item" v-if="pagination.prevPageUrl">
                <a class="page-link" @click="$emit('prev')">Previous</a>
            </li>

            <li class="page-item disabled" v-else>
                <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>


            <li class="page-item" v-if="pagination.nextPageUrl">
                <a class="page-link" @click="$emit('next')">Next</a>
            </li>

            <li class="page-item disabled" v-else>
                <a class="page-link" href="#" tabindex="-1">Next</a>
            </li>

        </ul>
    </nav>
</template>

<script>
    export default {
        props: ['pagination'],

        data () {
            return {
                data: null,
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

        created() {

        },

        methods: {
            setUp(x) {
                this.pagination.lastPage = data.last_page;
                this.pagination.currentPage = data.current_page;
                this.pagination.total = data.total;
                this.pagination.lastPageUrl = data.last_page_url;
                this.pagination.nextPageUrl = data.next_page_url;
                this.pagination.prevPageUrl = data.prev_page_url;
                this.pagination.from = data.from;
                this.pagination.to = data.to;
            }
        }
    }
</script>