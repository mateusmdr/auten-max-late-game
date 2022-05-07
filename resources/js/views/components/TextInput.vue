<template>
    <InputContainer :name="label">
        <div class="position-relative" v-if="multiline">
            <textarea type="text" @input="$emit('update:modelValue',$event.target.value)" :value="modelValue" :placeholder="placeholder">

            </textarea>
        </div>
        <div class="position-relative" v-else>
            <input type="text" @input="$emit('update:modelValue',$event.target.value)" :value="modelValue" :placeholder="placeholder"/>
            <div class="input-icon" v-if="hasIcon">
                <Icon :name="icon"/>
            </div>
        </div>
    </InputContainer>
</template>

<script>
export default {
    props: {
        modelValue: String,
        label: String,
        placeholder: {
            type: String,
            default: ""
        },
        hasIcon: {
            type: Boolean,
            default: false
        },
        icon: String,
        multiline: {
            type: Boolean,
            default: false,
        }
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

    textarea {
        height: 7.5rem;
        border-radius: .5rem;
        width: 100%;
        resize: none;

        background-color: #4F4F4F;
        color: #BFC9DB;
        padding: 1rem;
        box-sizing: border-box;

        border: 0;
        outline: 0;
    }
</style>