<template>
    <span class="material-icons-outlined" :style="`color:${color};font-size:${size};`">
        {{ name }}
    </span>
</template>

<script>
export default {
    props: {
        name: String,
        color: {
            type: String,
            default: 'inherit'
        },
        size: {
            type: String,
            default: '1.5rem'
        }
    }
}
</script>

<style scoped>
    span {
        color: inherit;
        vertical-align: middle;
    }
</style>