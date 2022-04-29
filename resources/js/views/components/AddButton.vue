<template>
    <button @click="$emit('click')">
        <span :class="confirm ? 'selected' : ''">Adicionar</span>
        <Icon :name="confirm ? 'check' : 'add'" :color="confirm ? '#05F28E' : '#BFC9DB'"/>
    </button>
</template>

<script>
export default {
    emits: ['click'],
    props: {
        confirm: Boolean
    }
}
</script>

<style scoped>
    span {
        color: #BFC9DB;
    }

    span.selected {
        color: #05F28E;
    }

    button {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: .5rem;
        margin: 2rem auto 0 auto;
    }
</style>