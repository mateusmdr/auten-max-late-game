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
            :startTime="startTime"
        />
    </InputContainer>
</template>

<script>
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
        },
        startTime() {
            return this.default ?
            {
                hours: format(this.default, 'HH'),
                minutes: format(this.default, 'mm'),
            } : null
        }
    },
    components: {Datepicker},
    props: {
        modelValue: Object,
        label: {
            type: String,
            default: "Hora"
        },
        default: Object
    }
}
</script>