<template>
    <Page>
        <div class="container d-flex justify-content-center my-5">
            <img src="@images/poker_chips_4.png" class="img-home">
        </div>

        <Section title="Notificações" description="Últimos avisos" icon="bi-bell">
            <div class="row">
                <div class="col-3 card-col">
                    <Card color='yellow' title="Título do Card" corner-text="Texto do canto">
                        <h6>Descrição</h6>
                    </Card>
                </div>
                <div class="col-3 card-col">
                    <Card color='yellow' title="Título do Card" corner-text="Texto do canto">
                        <h6>Descrição</h6>
                    </Card>
                </div>
                <div class="col-3 card-col">
                    <Card color='yellow' title="Título do Card" corner-text="Texto do canto">
                        <h6>Descrição</h6>
                    </Card>
                </div>
                <div class="col-3 card-col">
                    <Card color='yellow' title="Título do Card" corner-text="Texto do canto">
                        <h6>Descrição</h6>
                    </Card>
                </div>
            </div>
        </Section>
        <!-- <DynamicButton text="Dinâmico 1"/>
        <DynamicButton text="Dinâmico 2" :primary="false"/>
        <StaticButton text="Estático 1"/>
        <StaticButton text="Estático 2" :primary="false"/> -->

        <Section title="Agenda de hoje" description="Próximos torneios" icon="bi-calendar-week">
            <Table
                actionIcon='bi-alarm'
                actionText='relógio'
                :fields="[
                    {name: 'Dia', width: 1},
                    {name: 'Inscrição', width: 2},
                    {name: 'Plataforma', width: 2},
                    {name: 'Tipo torneio', width: 2},
                    {name: 'Buy-in Mín', width: 1},
                    {name: 'Buy-in Máx', width: 1},
                    {name: 'Recorrência', width: 1}
                ]"
            />
        </Section>

        <Ad/>
    </Page>
</template>

<script>
    import Page from './Page.vue';
    import Section from '../components/Section.vue';
    import DynamicButton from '../components/DynamicButton.vue';
    import StaticButton from '../components/StaticButton.vue';
    import Table from '../components/Table.vue';

    import Card from '../components/Card.vue';

    import Ad from '../components/client/Ad.vue';

    export default {
        components: {
            Page,
            DynamicButton,
            StaticButton,
            Card,
            Table,
            Ad,
            Section
        }
    }
</script>

<style scoped>
    .img-home {
        width: 7vw;
        height: auto;
    }

</style>