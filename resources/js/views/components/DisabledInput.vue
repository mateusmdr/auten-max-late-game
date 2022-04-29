<template>
    <InputContainer :name="label">
        <div class="position-relative">
            <div :class="`disabled-input ${primary ? 'primary' : 'secondary'}`">
                {{value}}
            </div>
            <button class="input-button" v-if="hasIcon" @click="$emit('click')">
                <Icon :name="icon"/>
            </button>
        </div>
    </InputContainer>
</template>

<script>
export default {
    emits: ['click'],
    props: {
        value: String,
        label: String,
        icon: {
            type: String,
            default: ""
        },
        hasIcon: {
            type: Boolean,
            default: false
        },
        primary: {
            type: Boolean,
            default: true
        }
    }
}
</script>

<style lang="scss" scoped>
    .disabled-input {
        height: 3rem;
        border-radius: .5rem;
        width: 100%;
        color: #BFC9DB;
        padding: 0 1rem;
        box-sizing: border-box;
        outline: 0;

        display: flex;
        align-items: center;

        &.primary{
            background-color: #232323;
            border: 1px solid #3E3E3E;
        }

        &.secondary {
            background-color: #4F4F4F;
            border: 0;
        }
    }
</style>