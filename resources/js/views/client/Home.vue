<template>
    <page>
        <div class="container d-flex justify-content-center my-5">
            <img src="@images/poker_chips_4.png" class="img-home">
        </div>
        <DynamicButton text="Dinâmico 1"/>
        <DynamicButton text="Dinâmico 2" :primary="false"/>
        <StaticButton text="Estático 1"/>
        <StaticButton text="Estático 2" :primary="false"/>
        <Card color='yellow' title="Título do Card" corner-text="Texto do canto">
            <h6>Descrição</h6>
        </Card>
        <Table
            actionIcon='alarm'
            actionText='relógio'
            :fields="[{name: 'n1', width: 2},{name: 'n2', width: 2},{name: 'n3', width: 2},{name: 'n4', width: 2},{name: 'n5', width: 2}]"
        />
    </page>
</template>

<script>
    import Page from './Page.vue';
    import DynamicButton from '../components/DynamicButton.vue';
    import StaticButton from '../components/StaticButton.vue';
    import Table from '../components/Table.vue';

    import Card from '../components/Card.vue';

    export default {
        components: {
            Page,
            DynamicButton,
            StaticButton,
            Card,
            Table
        }
    }
</script>

<style scoped>
    .img-home {
        width: 7vw;
        height: auto;
    }
</style>