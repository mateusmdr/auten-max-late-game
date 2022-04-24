<template>
    <InputContainer name="Hora">
        <Datepicker
            timePicker
            placeholder="00h00"
            locale="pt-BR"
            dark
            hideInputIcon
            v-model="date"
            format="HH:mm"
            autoApply
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
        value: Date
    },
    computed: {
        date: {
            get() {
                return this.value;
            },
            set(val) {
                this.$emit('input',val);
            }
        }
    }
}
</script>