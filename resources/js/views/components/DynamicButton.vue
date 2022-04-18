<template>
    <a :href="url">
        {{ text }}
    </a>
</template>

<script>
export default {
    props: {
        text: String,
        url: String
    }
}
</script>

<style scoped>
    a {
        color: white;
        background-color: #4040F4;
        font-weight: bold;
        padding: 12px 40px;
        border-radius: 24px;        
        cursor: pointer;
        transition: .2s;
        text-decoration: none;
        display: inline-block;
    }

    a:hover {
        color: #4040F4 !important;
        background-color: #BFC9DB;
    }
</style>