<template>
    <Section title="Próximos torneios" icon="emoji_events">
        <AdminCreateTournamentModal
            v-if="!selectedTournament"
        />

        <AdminEditTournamentModal
            v-else
            :tournament="selectedTournament"
            @close="selectedTournament = null"
        />

        <AdminTournamentsFilters
            @change="(filter) => this.filter = filter"
        />
        
        <AdminTournamentsTable
            :tournaments="tournaments"
            @select="editTournament"
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
            selectedTournament: null,
        }
    },
    methods: {
        editTournament(tournament) {
            console.log(tournament);
            this.selectedTournament = tournament;
        }
    }
}
</script>