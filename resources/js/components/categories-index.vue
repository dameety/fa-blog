<template>
    <div>

        <datatable :columns="columns" model_name="categories">
            <tbody slot="table_body" slot-scope="{data, checkedItem, editItem, viewItem, deleteItem, addToCheckedItemList}">

                <tr v-for="item in data" :key="item.id">
                    <td>
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input"
                                   @change="addToCheckedItemList(item.id)"
                                   aria-label="select a table item">
                            <span class="custom-control-label"></span>
                        </label>
                        <!--<label class="custom-control custom-checkbox">-->
                            <!--<input type="checkbox" class="custom-control-input"-->
                                   <!--v-model="checkedItem" :value="item.id"-->
                                   <!--@change="addToCheckedItem(item.id)"-->
                                   <!--aria-label="select a table item">-->
                            <!--<span class="custom-control-label"></span>-->
                        <!--</label>-->
                    </td>

                    <td>
                        {{item.name}}
                    </td>

                    <td>
                        {{item.description.substring(0, 55)}}
                    </td>

                    <td class="text-center">
                        <div class="item-action dropdown">
                            <a href="javascript:void(0)" data-toggle="dropdown" class="icon">
                                <i class="fe fe-more-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a :href="editItem(item)" class="dropdown-item">
                                    <i class="dropdown-icon fe fe-edit-2"></i>
                                    Edit
                                </a>
                                <div class="dropdown-divider"></div>
                                <a :href="viewItem(item)" class="dropdown-item">
                                    <i class="dropdown-icon fe fe-edit-2"></i>
                                    View
                                </a>
                                <div class="dropdown-divider"></div>
                                <a @click.prevent="deleteItem(item)" class="dropdown-item">
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
        name: "categories-index",

        components: {
            datatable
        },

        data () {
            let columns = [
                {label: 'Name', name: 'name', class: '', sortable: true},
                {label: 'Description', name: 'description', class: '', sortable: true}
            ];
            return {
                columns: columns
            }
        }
    }
</script>