<template>
    <div :class="visible ? 'visible' : 'invisible'">
        <h2>Ver mais</h2>
        <Icon name="expand_more"/>
    </div>
</template>

<script>
export default {
    props: {
        visible: {
            type: Boolean,
            default: true
        }
    }
}
</script>

<style scoped>
div{
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 4.25rem;
    cursor: pointer;
}
div h2{
    font-weight: 600;
    font-size: 16px;
    margin: 0;
    padding: 0;
    color: #BFC9DB;
}
</style>
