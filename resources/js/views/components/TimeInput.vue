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
            @update:modelValue="updateValue"
            selectText="Selecionar"
            cancelText="Cancelar"
        />
    </InputContainer>
</template>

<script>
import { ref } from 'vue';
import Datepicker from '@vuepic/vue-datepicker';
import { parse, format } from 'date-format-parse';

export default {
    setup(props, context) {
        const updateValue = (time) => {
            context.emit('update:modelValue', time ? parse(`${time.hours}:${time.minutes}`,'H:m') : null);
        }

        return {
            updateValue
        }
    },
    computed: {
        date() {
            return this.modelValue ?
            {
                hours: format(this.modelValue, 'HH'),
                minutes: format(this.modelValue, 'mm'),
            } : null
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