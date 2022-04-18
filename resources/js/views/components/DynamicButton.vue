<template>
    <a :href="url" :class="primary ? 'primary':'secondary'">
        {{ text }}
    </a>
</template>

<script>
export default {
    props: {
        text: String,
        url: String,
        primary: {
            type: Boolean,
            default: true
        }
    }
}
</script>

<style scoped>
    a {
        font-weight: bold;
        padding: 12px 40px;
        border-radius: 24px;        
        cursor: pointer;
        transition: .2s;
        text-decoration: none;
        display: inline-block;
    }

    a.primary {
        color: white;
        background-color: #4040F4;
    }

    a.secondary {
        color: #4040f4;
        background-color: #BFC9DB;
    }

    a.primary:hover {
        color: #4040F4 !important;
        background-color: #BFC9DB;
    }

    a.secondary:hover {
        color: white;
        background-color: #4040F4;
    }
</style>