<template>
    <button @click="onClick" :class="primary ? 'primary':'secondary'">
        {{ text }}
    </button>
</template>

<script>
export default {
    props: {
        text: String,
        primary: {
            type: Boolean,
            default: true
        },
        onClick: Function
    }
}
</script>

<style lang="scss" scoped>
    button {
        font-weight: bold;
        padding: 12px 40px;
        border-radius: 24px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        outline: 0;
        border: 0;

        &.primary {
            background-color: #4040F4;
            color: white;
        }

        &.secondary {
            color: #4040f4;
            background-color: #BFC9DB;
        }
    }
</style>