<template>
        <div class="container d-flex justify-content-center mb-3">
            <img src="@images/poker_chips_4.png" class="img-home">
        </div>

        <Section title="Principais índices" icon="timeline">
            <div class="row my-5">
                <div class="col-3 card-col">
                    <Card color='#F5A847'>
                        <div class="custom-card-body">
                            <h3>000000</h3>
                            <h4>Usuários cadastrados</h4>
                        </div>
                    </Card>
                </div>
                <div class="col-3 card-col">
                    <Card color='#05F28E'>
                        <div class="custom-card-body">
                            <h3>R$ 0000,00</h3>
                            <h4>Em mensalidades pagas</h4>
                        </div>
                    </Card>
                </div>
                <div class="col-3 card-col">
                    <Card color='#B376F8'>
                        <div class="custom-card-body">
                            <h3>000000</h3>
                            <h4>Torneios cadastrados</h4>
                        </div>
                    </Card>
                </div>
                <div class="col-3 card-col">
                    <Card color='#EB4263'>
                        <div class="custom-card-body">
                            <h3>R$ 0000,00</h3>
                            <h4>Em anúncios pagos</h4>
                        </div>
                    </Card>
                </div>
            </div>
        </Section>

        <div class="py-4"></div>

        <Section title="Resumo de hoje" description="Principais índices" icon="timeline">
            <div class="row my-5">
                <div class="col-3 card-col">
                    <Card color='#F5A847'>
                        <div class="custom-card-body">
                            <h3>000000</h3>
                            <h4>Usuários novos</h4>
                        </div>
                    </Card>
                </div>
                <div class="col-3 card-col">
                    <Card color='#05F28E'>
                        <div class="custom-card-body">
                            <h3>R$ 0000,00</h3>
                            <h4>Em mensalidades pagas</h4>
                        </div>
                    </Card>
                </div>
                <div class="col-3 card-col">
                    <Card color='#B376F8'>
                        <div class="custom-card-body">
                            <h3>000000</h3>
                            <h4>Torneios acontecendo</h4>
                        </div>
                    </Card>
                </div>
            </div>
        </Section>

        <div class="py-4"></div>
        
        <Section title="Resumo do mês" description="Principais índices" icon="timeline">
            <div class="row my-5">
                <div class="col-3 card-col">
                    <Card color='#F5A847'>
                        <div class="custom-card-body">
                            <h3>000000</h3>
                            <h4>Usuários novos</h4>
                        </div>
                    </Card>
                </div>
                <div class="col-3 card-col">
                    <Card color='#05F28E'>
                        <div class="custom-card-body">
                            <h3>R$ 0000,00</h3>
                            <h4>Em mensalidades pagas</h4>
                        </div>
                    </Card>
                </div>
                <div class="col-3 card-col">
                    <Card color='#B376F8'>
                        <div class="custom-card-body">
                            <h3>000000</h3>
                            <h4>Torneios acontecendo</h4>
                        </div>
                    </Card>
                </div>
            </div>
        </Section>

        <div class="py-5"></div>
</template>

<script>
import Section from '../components/Section.vue';
import Card from '../components/Card.vue';

export default {
    components: {
        Section,
        Card
    }
}
</script>

<style scoped>
    .custom-card-body h3 {
        font-size: 1.5rem;
    }

    .card-col {
        padding-right: 2rem;
    }
</style>