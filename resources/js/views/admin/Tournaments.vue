<template>
    <Section title="Próximos torneios" icon="emoji_events">
        <AdminCreateTournamentModal/>

        <AdminTournamentsFilters
            @change="(filter) => this.filter = filter"
        />

        <AdminTournamentsTable
            :tournaments="filteredTournaments"
        />
    </Section>
</template>

<script>
    export default {
        computed: {
            filteredTournaments() {
                return this.tournaments.filter(this.filter);
            }
        },
        mounted() {

        },
        data() {
            return {
                filter: () => true,
                data: null,
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
                ).concat(Array(4).fill(
                    {
                        id: 1,
                        title: 'Título do torneio',
                        color: '#EB4263',
                        values: [
                            '00/00/0000',
                            '00h00 às 00h00',
                            'Party Poker',
                            'Cash Game',
                            '0000',
                            '0000',
                            '0000'
                        ],
                        isEditable: true,
                        actions: {
                            delete: () => console.log('Deletar'),
                            edit: () => console.log('Editar'),
                            approve: () => console.log('Aprovar'),
                        }
                    }
                ))
            }
        }
    }
</script>