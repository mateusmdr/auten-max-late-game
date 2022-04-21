<template>
    <div class="custom-card position-relative">
        <h6 class="position-absolute corner-text">{{ cornerText }}</h6>
        <div class="custom-card-content" :style="`border-left-color: ${ color };`">
            <slot/>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        cornerText: {
            type: String,
            default: ''
        },
        color: String,
        title: String
    }
}
</script>

<style scoped>
    .custom-card {
        padding: 2.25rem 1.5rem;
        background-color: #232323;
        border-radius: 8px;
    }

    .corner-text {
        color: #58606C;
        right: 1.5rem;
        top: 1rem;
    }

    .custom-card-content {
        border-left: 2px solid transparent;
        padding-left: 16px;
        box-sizing: border-box;
    }

</style>

<style>
    .custom-card-body h3{
        color: #BFC9DB;
        font-size: 1rem;
        font-weight: 700;
    }

    .custom-card-body h4{
        color: #7F8896;
        font-weight: 600;
    }
</style>