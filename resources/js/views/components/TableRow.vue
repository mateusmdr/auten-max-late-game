<template>
    <div class="row px-3">
        <table-col :key="'title'" :width="2">
            <div class="title-col" :style="`border-left-color:${color};`">
                <h4>{{ title }}</h4>
            </div>
        </table-col>

        <table-col v-for="(field,index) in fields" :key="field.name" :width="field.width">
            <div class="default-col">
                <h4>{{ values[index] }}</h4>
            </div>
        </table-col>

        <table-col :key="'action'" :width="1">
            <div class="action-col" @click="action">
                <icon :name="actionIcon" :color="color" size="1.2rem"/>
                <h4 :style="`color: ${color};`"> {{ actionText }} </h4>
            </div>
        </table-col>
    </div>
</template>

<script>
import Icon from './Icon.vue'
import TableCol from './TableCol.vue'

export default {
  components: { TableCol, Icon },
    props: {
        title: String,
        color: String,
        action: Function,
        actionIcon: String,
        actionText: String,
        fields: Array,
        values: Array
    }
}
</script>

<style scoped>
    .row {
        background-color: #232323;
        min-height: 4.25rem;
        margin-bottom: 8px;
        border-radius: 8px;
    }

    h4 {
        margin-bottom: 0;
    }

    .title-col {
        border-left: 2px solid transparent;
    }

    .title-col h4 {
        padding-left: 16px;
        color: #BFC9DB;
        font-weight: 700;
    }

    .action-col {
        cursor: pointer;
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .action-col h4{
        font-weight: 600;
        padding-left: 8px;
    }
</style>