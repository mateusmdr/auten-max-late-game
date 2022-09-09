<template>
    <InputContainer :name="label">
        <div class="position-relative">
            <input
                type="text"
                @input="$emit('update:modelValue',$event.target.value)"
                :value="modelValue"
                placeholder="HH:mm"
                v-mask="'##:##'"
            />
            <div class="input-icon">
                <Icon name="access_time"/>
            </div>
        </div>
    </InputContainer>
</template>

<script>
export default {
    props: {
        modelValue: String,
        label: {
            type: String,
            default: "Hora"
        },
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
