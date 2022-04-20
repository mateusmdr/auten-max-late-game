<template>
    <i :class="`bi ${name}`" :style="`color:${color};font-size:${size};`"></i>
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
    i::before {
        color: inherit;
    }
</style>