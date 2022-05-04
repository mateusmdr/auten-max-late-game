<template>
    <Section title="Próximos torneios" icon="emoji_events">
        <AdminCreateTournamentModal/>

        <AdminTournamentsFilters
            @change="(filter) => this.filter = filter"
        />

        <AdminTournamentsTable
            :tournaments="tournaments"
        />
    </Section>
</template>

<script>
    export default {
        computed: {
            filteredTournaments() {
                return tournaments && this.tournaments.filter(this.filter);
            }
        },
        mounted() {
            axios
                .get('/api/tournament')
                .then(response => {
                    this.tournaments = response.data.data;
                })
                .catch(error => {
                    console.error(error)
                });
        },
        data() {
            return {
                filter: () => true,
                tournaments: null
            }
        }
    }
</script>