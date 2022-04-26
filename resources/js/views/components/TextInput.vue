<template>
    <InputContainer :name="label">
        <div class="position-relative">
            <input type="text" @input="$emit('update:modelValue',$event.target.value)" :value="modelValue"/>
            <div class="input-icon" v-if="hasIcon">
                <Icon :name="icon"/>
            </div>
        </div>
    </InputContainer>
</template>

<script>
import InputContainer from './InputContainer.vue';
import Icon from './Icon.vue';

export default {
    components: {
        InputContainer,
        Icon
    },
    props: {
        modelValue: String,
        label: String,
        hasIcon: {
            type: Boolean,
            default: false
        },
        icon: String
    },
}
</script>

<style scoped>
    input {
        height: 3rem;
        border-radius: .5rem;
        width: 100%;

        background-color: #4F4F4F;
        color: #BFC9DB;
        padding: 0 1rem;
        box-sizing: border-box;

        border: 0;
        outline: 0;
    }
</style>