<template>
    <div class="input-container">
        <label class="mb-1">{{name}}</label>
        <slot/>
    </div>
</template>

<script>
export default {
    props: {
        name: String
    }
}
</script>

<style scoped>
    label {
        display: block;
        color: #F2F5FA;
        font-weight: 700;
        font-size: .75rem;
    }
</style>