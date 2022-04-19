<template>
    <i :class="`bi ${name}`" :style="`color:${color};`"></i>
</template>

<script>
export default {
    props: {
        name: String,
        color: {
            type: String,
            default: 'inherit'
        }
    }
}
</script>

<style scoped>
    i {
        font-size: 1.5em;
    }

    i::before {
        color: inherit;
    }
</style>