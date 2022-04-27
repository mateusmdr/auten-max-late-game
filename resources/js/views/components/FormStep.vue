<template>
    <div class="form-step d-flex flex-row align-items-center me-4">
        <div class="circle" v-if="modelValue === pageNumber"></div>
        <a :class="modelValue===pageNumber ? 'currentPage' : ''" @click="$emit('update:modelValue',pageNumber)">{{text}}</a>
    </div>
</template>

<script>
export default {
    props: {
        modelValue: Number,
        pageNumber: Number,
        text: String
    }
}
</script>

<style scoped>
    .circle {
        background-color: #05F28E;
    }

    a {
        text-decoration: none;
        color: #7F8896;
        font-weight: 600;
        font-size: 1rem;
        padding-left: .5rem;
        cursor: pointer;
        transition: .2s;
    }

    a.currentPage {
        color: #F2F5FA;
        cursor: default;
    }

    a:hover {
        color: #F2F5FA;
    }
</style>

