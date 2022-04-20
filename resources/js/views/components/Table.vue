<template>
    <div class="container-fluid">
        <div class="row table-header px-3">
            <div class="col-2"></div>

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
    props: {
        actionIcon: String,
        actionText: String,
        fields: Array,
        items: Array
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
</style>