<template>
    <div class="fluid-container table-container">
        <div class="row table-header">
            <div class="col-1"></div>

            <table-col v-for="field in fields" :key="field.name" :width="field.width">
                <div>
                    <h4>{{ field.name }}</h4>
                </div>
            </table-col>

            <div class="col-1"></div>
        </div>

        <table-row 
            v-for="(item, index) in items"
            :key="index"
            :fields="fields"
            :title="item.title"
            :color="item.color"
            :values="item.values"
            :action="item.action"
            :actionIcon="actionIcon"
            :actionText="actionText"
        />
    </div>
</template>

<script>
import TableRow from './TableRow.vue'
import TableCol from './TableCol.vue'

export default {
  components: { TableRow, TableCol },
    data: function() {
        return {
            items: [
                {title: 'Título 1', color: '#B376F8', values: [1,2,3,4,5], action: () => console.log("fui clicado 1")},
                {title: 'Título 2', color: 'green', values: [11,22,33,44,55], action: () => console.log("fui clicado 2")},
                {title: 'Título 3', color: 'blue', values: [111,222,333,444,555], action: () => console.log("fui clicado 3")}
            ],
        }
    },
    props: {
        actionIcon: String,
        actionText: String,
        fields: Array
    }
}
</script>

<style scoped>
    .table-header {
        height: 2.75rem;
        background-color: #232323;
        border-radius: 8px;
        margin-bottom: 8px;
    }

    .table-header h4 {
        margin-bottom: 0;
        font-weight: 700;
    }

    .table-container {
        width: calc(100% - 8em);
        margin: auto;
    }
</style>