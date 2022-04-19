<template>
    <div :class="'table-col col-' + width">
        <slot/>
    </div>
</template>

<script>
export default {
    props: {
        width: Number
    }
}
</script>

<style scoped>
    .table-col {
        display: flex;
        align-items: center;
        color: #7F8896;
    }
</style>