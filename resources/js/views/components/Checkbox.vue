<template>
    <div class="input-container" @click="$emit('update:modelValue',!modelValue)">
        <span class="checkbox-icon" :style="`background-color: ${modelValue ? '#4040F4' : '#3E3E3E'};`">
            <Icon :name="modelValue? 'check' : ''" color="white" size="1.5rem"/>
        </span>
        <label>{{label}}</label>
    </div>
</template>

<script>
export default {
    props: {
        modelValue: Boolean,
        label: String
    },
}
</script>

<style scoped>
    .input-container {
        display: flex;
        flex-direction: row;
        column-gap: .75rem;
        align-items: center;
    }
    .checkbox-icon {
        width: 1.75rem;
        height: 1.75rem;
        border-radius: .25rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }
    label {
        color: #BFC9DB;
        font-weight: 600;
        font-size: 1rem;
    }
</style>