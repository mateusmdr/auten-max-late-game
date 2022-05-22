<template>
    <Section title="Próximos torneios" icon="emoji_events">

        <ClientTournamentsFilters
            @change="(newFilter) => this.filter = newFilter"
        />

        <ClientTournamentsTable
            :tournaments="filteredTournaments"
            @select="(tournament) => selectedTournament = tournament"
        />

        <ClientEnableNotificationModal
            v-if="!!selectedTournament"
            :tournament="selectedTournament"
            @close="selectedTournament = null"
        />
    </Section>
</template>

<script>
import { storeToRefs } from 'pinia';
import {useTournamentStore} from '../../stores/client';

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
    methods: {
        selectTournament(tournament) {
            this.selectedTournament = tournament;
        }
    },
    data() {
        return {
            filter: () => true,
            selectedTournament: null
        }
    },
}
</script>