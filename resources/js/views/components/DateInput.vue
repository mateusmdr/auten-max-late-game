<template>
    <InputContainer :name="label">
        <Datepicker 
            :placeholder="monthPicker ? '00/00' : '00/00/0000'"
            :enableTimePicker="false"
            locale="pt-BR"
            autoApply
            :minDate="minDate && now"
            dark
            hideInputIcon
            v-model="modelValue"
            @input="$emit('update:modelValue',$event.target.value)"
            :format="monthPicker ? 'MM/yyyy' : 'dd/MM/yyyy'"
            :monthPicker="monthPicker"
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
        monthPicker: {
            type: Boolean,
            default: false
        },
        label: {
            type: String,
            default: "Data"
        },
        minDate : {
            type: Boolean,
            default: true
        }
    }
}
</script>

<style lang="scss">
    @import '@vuepic/vue-datepicker/dist/main.css';
    
    .dp__theme_dark {
        --dp-background-color: #4F4F4F;
        --dp-text-color: #BFC9DB;
        --dp-hover-color: #232323;
        --dp-hover-text-color: #BFC9DB;
        --dp-border-color: transparent;
        --dp-border-color-hover: transparent;
        --dp-success-color: #05f28e;

        --dp-primary-text-color: #BFC9DB;
    }

    .dp__input {
        min-height: 3rem;
        border-radius: .5rem;
        &::placeholder {
            color: #BFC9DB;
        }
        &:-ms-input-placeholder {
            color: #BFC9DB;
        }
        &::-ms-input-placeholder{
            color: #BFC9DB;
        }
    }
</style>