<template>
    <button @click.prevent="copyText">
        <div class="me-5">{{ text }}</div>
        <Icon name="content_copy"/>
    </button>
</template>

<script>
import Icon from "./Icon";
export default {
    components: {Icon},
    props: {
        text: String,
        primary: {
            type: Boolean,
            default: true
        }
    },
    methods: {
        copyText() {
            navigator.clipboard.writeText(this.text);
        }
    }
}
</script>

<style lang="scss" scoped>
    button {
        padding: 12px 24px;
        border-radius: 8px;
        cursor: pointer;
        text-decoration: none;
        outline: 0;
        border: 0;
        background-color: #3E3E3E;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        vertical-align: middle;
        font-weight: 400;
        font-size: 1rem;
        color: #F2F5FA;
        width: 360px;
        justify-content: space-between;
    }

    button * {
        vertical-align: middle;
        font-weight: 400;
        font-size: 1rem;
        color: #F2F5FA;
    }
</style>
