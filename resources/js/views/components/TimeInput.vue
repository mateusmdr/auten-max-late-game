<template>
    <InputContainer name="Hora">
        <Datepicker
            timePicker
            placeholder="00h00"
            locale="pt-BR"
            dark
            hideInputIcon
            v-model="modelValue"
            @input="$emit('update:modelValue',$event.target.value)"
            format="HH:mm"
            selectText="Selecionar"
            cancelText="Cancelar"
        />
    </InputContainer>
</template>

<script>
import { ref } from 'vue';
import Datepicker from '@vuepic/vue-datepicker';

import InputContainer from './InputContainer.vue';

export default {
    setup() {
        const now = ref(new Date());

        return {
            now
        }
    },
    components: { Datepicker, InputContainer },
    props: {
        modelValue: Date
    }
}
</script>