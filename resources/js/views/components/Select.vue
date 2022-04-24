<template>
    <InputContainer :name="name">
        <div class="position-relative">
            <select v-model="option" ref="select">
                <option :value="null" selected hidden>Selecione</option>
                <option v-for="item in options" :key="item.value" :value="item">{{item.name}}</option>
            </select>
            <label class="select-icon">
                <Icon name="keyboard_arrow_down"/>
            </label>
        </div>
    </InputContainer>
</template>

<script>
import InputContainer from './InputContainer.vue';
import Icon from './Icon.vue';

export default {
    components: { InputContainer, Icon },
    props: [
        'name',
        'options',
        'value'
    ],
    computed: {
        option: {
            get() {
                return this.value;
            },
            set(val) {
                console.log(val);
                this.$emit('input',val);
            }
        },
    },
}
</script>

<style scoped>
    select {
        height: 3rem;
        border-radius: .5rem;
        width: 100%;
        vertical-align: middle;

        background-color: #4F4F4F;
        color: #BFC9DB;
        padding: 0 1rem;
        box-sizing: border-box;

        border: 0;
        outline: 0;
        border-radius: .5rem;

        -webkit-appearance: none;
        overflow: visible;
    }

    select::-ms-expand {
        display: none;
    }

    option {
        background-color: #4F4F4F;
        height: 3rem;
    }
    
    .select-icon {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        color: #BFC9DB;
        pointer-events: none;
    }

</style>