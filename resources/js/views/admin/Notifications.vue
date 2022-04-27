<template>
    <Section title="Notificações" description="Últimos avisos" icon="notifications">
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
</template>

<script>
    export default {
        data: function() {
            return {
                tournaments: Array(8).fill(
                    {
                        title: 'Título do torneio',
                        color: '#B376F8',
                        values: [
                            '00/00/0000',
                            '00h00 às 00h00',
                            'Party Poker',
                            'Cash Game',
                            '$ 0000,00',
                            '$ 000000,00',
                            'R$ 00000,00'
                        ],
                        action: () => console.log("fui clicado")
                    }
                )
            }
        }
    }
</script>

<style scoped>
    .img-home {
        width: 7vw;
        height: auto;
    }

</style>