<template>
    <Section title="Próximos torneios" icon="emoji_events">

        <ClientTournamentsFilters/>

        <ClientTournamentsTable
            :tournaments="tournaments"
        />
    </Section>
</template>

<script>
    export default {
        data() {
            return {
                tournaments: Array(4).fill(
                    {
                        id: 1,
                        title: 'Título do torneio',
                        color: '#05F28E',
                        values: [
                            '00/00/0000',
                            '00h00 às 00h00',
                            'Party Poker',
                            'Cash Game',
                            '0000',
                            '0000',
                            '0000'
                        ],
                        isEditable: false,
                        defaultAction: () => console.log("fui clicado")
                    }
                )
            }
        }
    }
</script>