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
import { storeToRefs } from 'pinia';
import {useTournamentPlatformStore, useTournamentTypeStore, useTournamentStore} from '../../stores/admin';

export default {
    setup() {
        const tournamentTypeStore = useTournamentTypeStore();
        const tournamentPlatformStore = useTournamentPlatformStore();
        const tournamentStore = useTournamentStore();
        tournamentTypeStore.refresh();
        tournamentPlatformStore.refresh();
        tournamentStore.refresh();

        const {tournaments} = storeToRefs(tournamentStore);
        return {
            tournaments
        }
    },
    computed: {
        filteredTournaments() {
            return tournaments && this.tournaments.filter(this.filter);
        }
    },
    data() {
        return {
            filter: () => true,
        }
    }
}
</script>