<template>
    <div class="radio-chips">
        <Chip
            v-for="item, index in chips"
            :key="item.text"

            :text="item.text"
            :color="item.color"
            :hasIcon="item.hasIcon"

            :selected="modelValue === index"
            @click="$emit('update:modelValue', index)"
        />
    </div>
</template>

<script>
export default {
    props: {
        chips: Array,
        modelValue: Number
    },
}
</script>

<style scoped>
    .radio-chips {
        display: flex;
        flex-direction: row;
        column-gap: 1rem;
    }
</style>