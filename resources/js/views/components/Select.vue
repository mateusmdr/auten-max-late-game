<template>
    <InputContainer :name="name">
        <div class="position-relative">
            <select :value="modelValue" @change="this.$emit('update:modelValue', $event.target.value)">
                <option value="" selected disabled hidden>Selecione</option>
                <option v-for="item in options" :key="item.value" :value="item">{{item.name}}</option>
            </select>
            <label class="select-icon unselectable">
                <Icon name="keyboard_arrow_down"/>
            </label>
        </div>
    </InputContainer>
</template>

<script>
export default {
    props: [
        'name',
        'options',
        'modelValue'
    ],
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
        cursor: pointer;
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
        color: #BFC9DB;
        pointer-events: none;
    }

</style>