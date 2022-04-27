<template>
    <div :class="`table-col col-${width} ${justifyEnd ? 'justify-content-end' : ''}`">
        <slot/>
    </div>
</template>

<script>
export default {
    props: {
        width: Number,
        justifyEnd: {
            type: Boolean,
            default: false
        }
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