<template>
    <button @click="$emit('click')" :class="primary ? 'primary':'secondary'">
        {{ text }}
    </button>
</template>

<script>
export default {
    props: {
        emits: ['click'],
        text: String,
        primary: {
            type: Boolean,
            default: true
        }
    }
}
</script>

<style lang="scss" scoped>
    button {
        font-weight: bold;
        padding: 12px 40px;
        border-radius: 24px;
        cursor: pointer;
        transition: .2s;
        text-decoration: none;
        display: inline-block;
        outline: 0;
        border: 0;

        &.primary {
            color: white;
            background-color: #4040F4;
        }

        &.secondary {
            color: #4040f4;
            background-color: #BFC9DB;
        }

        &.primary:hover {
            color: #4040F4 !important;
            background-color: #BFC9DB;
        }

        &.secondary:hover {
            color: white;
            background-color: #4040F4;
        }
    }
</style>