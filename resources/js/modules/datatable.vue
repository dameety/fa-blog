<template>
    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
        <thead>
            <tr>
                <th></th>
                <th v-for="column in columns"
                    :key="column.name"
                    @click="$emit('sort', column.name)"
                    :class="[
                        sortKey === column.name
                        ? (
                            sortOrders[column.name] > 0
                            ? 'glyphicon glyphicon-arrow-down'
                            : 'glyphicon glyphicon-arrow-up'
                        )
                        : 'glyphicon glyphicon-arrow-down',
                        column.class
                    ]"
                    :style="'cursor:pointer;'">

                    <i class="fe fe-ICON_NAME"></i>
                    {{column.label}}

                </th>

                <th class="text-center">
                    <i class="icon-settings"></i>
                </th>
            </tr>
        </thead>

        <slot name="table_body"></slot>
    </table>
</template>

<script>
    export default {
        props: ['columns', 'sortKey', 'sortOrders']
    }
</script>

glyphicon glyphicon-triangle-bottom

:class="[
sortKey === column.name ? (sortOrders[column.name] > 0 ? 'sorting_asc' : 'sorting_desc') : 'sorting',
column.class
]"



:class="[
sortKey === column.name
? (
sortOrders[column.name] > 0
? 'fa fa-angle-down'
: 'fa fa-angle-up'
)
: 'sorting',
column.class
]"