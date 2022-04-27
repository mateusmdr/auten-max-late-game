<template>
    <div class="container-fluid">
        <div class="row table-header px-3">
            <div class="col-2"></div>

            <table-col v-for="field in fields" :key="field.name" :width="field.width">
                <div>
                    <h4>{{ field.name }}</h4>
                </div>
            </table-col>

            <div :class="`col-${actionWidth}`"></div>
        </div>

        <table-row 
            v-for="item in items"
            :key="item.id"
            :fields="fields"
            :title="item.title"
            :color="item.color"
            :values="item.values"
            :defaultAction="item.action"
            :defaultActionIcon="defaultActionIcon"
            :defaultActionText="defaultActionText"
            :isEditable="item.isEditable"
            :actions="item.actions"
            :actionWidth="actionWidth"
        />
    </div>
</template>

<script>
export default {
    props: {
        defaultActionIcon: String,
        defaultActionText: String,
        fields: Array,
        items: Array,
        actions: Array,
        actionWidth: {
            type: Number,
            default: 1
        }
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