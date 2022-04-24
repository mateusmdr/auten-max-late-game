<template>
    <InputContainer :name="name">
        <input type="number" v-model.number="value" @input="$emit('input',$event.target.value)" :min="positive && '0'"/>
    </InputContainer>
</template>

<script>
import InputContainer from '../components/InputContainer.vue';

export default {
    components: {InputContainer},
    props: {
        name: {
            type: String,
            default: "Número"
        },
        value: Number,
        positive: {
            type: Boolean,
            default: true
        }
    }
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
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    input[type=number] {
    -moz-appearance: textfield;
    }
</style>