<template>
    <div class="radio-chips">
        <Chip
            v-for="item, index in chips"
            :key="item.text"

            :text="item.text"
            :color="item.color"
            :hasIcon="item.hasIcon"

            :selected="index === selectedIndex"
            @click="() => setIndex(index)"
        />
    </div>
</template>

<script>
import Chip from './Chip.vue';

export default {
    components: {Chip},
    props: {
        chips: Array,
        selectedIndex: Number,
        setIndex: Function
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