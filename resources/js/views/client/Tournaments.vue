<template>
    <Section title="Próximos torneios" icon="emoji_events">

        <ClientTournamentsFilters
            @change="(newFilter) => this.filter = newFilter"
        />

        <ClientTournamentsTable
            :tournaments="filteredTournaments"
        />
    </Section>
</template>

<script>
import { storeToRefs } from 'pinia';
import {useTournamentStore} from '../../stores/admin';

export default {
    setup() {
        const tournamentStore = useTournamentStore();
        tournamentStore.refresh();

        const {tournaments} = storeToRefs(tournamentStore);
        return {
            tournaments
        }
    },
    computed: {
        filteredTournaments() {
            return this.tournaments.filter(this.filter);
        }
    },
    data() {
        return {
            filter: () => true,
        }
    },
}
</script>