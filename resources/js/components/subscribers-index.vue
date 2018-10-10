<template>
    <div>

        <datatable :columns="columns" model_name="subscribers">
            <tbody slot="table_body" slot-scope="{data, checkedItem, deleteItem, addToCheckedItemList}">

                <tr v-for="item in data" :key="item.id">
                    <td>
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input"
                               @change="addToCheckedItemList(item.id)"
                               aria-label="select a table item">
                            <span class="custom-control-label"></span>
                        </label>
                    </td>

                    <td>
                        {{item.email}}
                        <span id="status">{{item.status}}</span>
                    </td>

                    <td>
                        {{item.created_at}}
                    </td>

                    <td class="text-center">
                        <button class="btn btn-outline-primary btn-sm"
                            @click.prevent="deleteItem(item)">
                            Delete
                        </button>
                    </td>
                </tr>

            </tbody>
        </datatable>

    </div>
</template>

<script>
    import datatable from '../modules/mega-datatable.vue'

    export default {
        name: "subscribers-index",

        components: {
            datatable
        },

        data () {
            let columns = [
                {label: 'Email', name: 'email', class: '', sortable: true},
                {label: 'Subscribed on', name: 'created_at', class: '', sortable: true}
            ];
            return {
                columns: columns
            }
        }
    }
</script>

<style scoped>
    #status {
        background-color: lightblue;
        color: #000;
        font-size: 12px;
        padding-left: 5px;
        padding-right: 5px;
        border-radius: 5px;
    }
</style>