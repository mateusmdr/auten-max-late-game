<template>
    <button :class="primary ? 'primary':'secondary'" :type="type" v-if="!isLoading">
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
        type: {
            type: String,
            default: "submit"
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
