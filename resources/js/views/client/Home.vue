<template>
    <div class="container d-flex justify-content-center mb-3">
        <img src="@images/poker_chips_4.png" class="img-home">
    </div>

    <Section title="Notificações" description="Últimos avisos" icon="notifications">
        <div class="row">
            <div class="col-3 card-col">
                <Card color='yellow' corner-text="Texto do canto">
                    <div class="custom-card-body">
                        <h3>Título do Card</h3>
                        <h4>Descrição</h4>
                    </div>
                </Card>
            </div>
            <div class="col-3 card-col">
                <Card color='yellow' corner-text="Texto do canto">
                    <div class="custom-card-body">
                        <h3>Título do Card</h3>
                        <h4>Descrição</h4>
                    </div>
                </Card>
            </div>
            <div class="col-3 card-col">
                <Card color='yellow' corner-text="Texto do canto">
                    <div class="custom-card-body">
                        <h3>Título do Card</h3>
                        <h4>Descrição</h4>
                    </div>
                </Card>
            </div>
            <div class="col-3 card-col">
                <Card color='yellow' corner-text="Texto do canto">
                    <div class="custom-card-body">
                        <h3>Título do Card</h3>
                        <h4>Descrição</h4>
                    </div>
                </Card>
            </div>
        </div>
    </Section>

    <Section title="Agenda de hoje" description="Próximos torneios" icon="date_range">
        <Table
            defaultActionIcon='alarm_off'
            defaultActionText='Desativar'
            :fields="tournamentFields"
            :items="tournaments"
        />
    </Section>
</template>

<script>
    export default {
        data: function() {
            return {
                tournamentFields: [
                    {name: 'Dia', width: 1},
                    {name: 'Inscrição', width: 2},
                    {name: 'Plataforma', width: 2},
                    {name: 'Tipo torneio', width: 1},
                    {name: 'Buy-in Mín', width: 1},
                    {name: 'Buy-in Máx', width: 1},
                    {name: 'Prêmio', width: 1}
                ],
                tournaments: Array(8).fill(
                    {
                        title: 'Título do torneio',
                        color: '#B376F8',
                        values: [
                            '00/00/0000',
                            '00h00 às 00h00',
                            'Party Poker',
                            'Cash Game',
                            '0000',
                            '0000',
                            '0000'
                        ],
                        action: () => console.log("fui clicado")
                    }
                )
            }
        }
    }
</script>

<style scoped>
    .custom-card-body {
        min-height: 5.25rem;
    }
</style>