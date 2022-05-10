<template>
    <InputContainer :name="label">
        <Datepicker
            timePicker
            placeholder="00:00"
            locale="pt-BR"
            dark
            hideInputIcon
            format="HH:mm"
            v-model="date"
            @internalModelChange="updateValue"
            selectText="Selecionar"
            cancelText="Cancelar"
        />
    </InputContainer>
</template>

<script>
import { ref } from 'vue';
import Datepicker from '@vuepic/vue-datepicker';

export default {
    setup(props, context) {
        const date = ref(props.modelValue);

        const updateValue = (date) => {
            context.emit('update:modelValue', date);
        }

        return {
            date,
            updateValue
        }
    },
    components: {Datepicker},
    props: {
        modelValue: Object,
        label: {
            type: String,
            default: "Hora"
        }
    }
}
</script>