<template>
    <div class="radio-container unselectable" v-for="option, index in options" :key="option.value" @click="$emit('update:modelValue', index)">
        <span class="radio-icon">
            <Icon :name="modelValue === index ? 'radio_button_checked' : 'radio_button_unchecked'" color="#4040F4" size="1.75rem"/>
        </span>
        <label>{{option.text}}</label>
    </div>
</template>

<script>
export default {
    props: {
        options: Array,
        modelValue: Number,
    }
}
</script>

<style lang="scss" scoped>
    .radio-container {
        display: flex;
        flex-direction: row;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .radio-icon {
        cursor: pointer;
        margin-right: .75rem;
    }

    label {
        cursor: pointer;
        color: #BFC9DB;
        font-weight: 600;
        font-size: 1rem;
    }
</style>