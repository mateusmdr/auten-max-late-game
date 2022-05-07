<template>
    <InputContainer :name="label">
        <Datepicker
            timePicker
            placeholder="00h00"
            locale="pt-BR"
            dark
            hideInputIcon
            v-model="modelValue"
            @internalModelChange="(date) => this.$emit('update:modelValue',date)"
            format="HH:mm"
            selectText="Selecionar"
            cancelText="Cancelar"
        />
    </InputContainer>
</template>

<script>
import { ref } from 'vue';
import Datepicker from '@vuepic/vue-datepicker';

export default {
    setup() {
        const now = ref(new Date());

        return {
            now
        }
    },
    components: {Datepicker},
    props: {
        modelValue: Date,
        label: {
            type: String,
            default: "Hora"
        }
    }
}
</script>