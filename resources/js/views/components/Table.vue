<template>
    <div class="container-fluid">
        <div class="row table-header px-3">
            <table-col v-for="field in fields" :key="field.name" :width="field.width">
                <div>
                    <h4>{{ field.name }}</h4>
                </div>
            </table-col>

            <div :class="`col-${actionWidth}`" v-if="!noAction"></div>
        </div>

        <table-row 
            v-for="item in items"
            :key="item.id"
            :fields="fields"
            :title="item.title"
            :color="colorPicker(item)"
            :item="item"
            :defaultAction="() => action(item)"
            :defaultActionIcon="defaultActionIcon || actionIcon(item)"
            :defaultActionText="defaultActionText || actionText(item)"
            :isEditable="isEditable(item)"
            :actions="{
                'delete': () => deleteAction(item),
                'edit': () => editAction(item),
                'approve': () => approveAction(item),
            }"
            :actionWidth="actionWidth"
            :noAction="noAction || disableAction(item)"
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
        approveAction: {
            type: Function,
            default: () => null
        },
        editAction: {
            type: Function,
            default: () => null
        },
        deleteAction: {
            type: Function,
            default: () => null
        },
        actionWidth: {
            type: Number,
            default: 1
        },
        noAction: {
            type: Boolean,
            default: false
        },
        colorPicker: {
            type: Function,
            default: () => null
        },
        action: {
            type: Function,
            default: () => null
        },
        actionText: {
            type: Function,
            default: () => null
        },
        actionIcon: {
            type: Function,
            default: () => null
        },
        disableAction: {
            type: Function,
            default: () => false
        },
        isEditable: {
            type: Function,
            default: () => null
        },
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