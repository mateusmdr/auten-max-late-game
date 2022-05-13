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
            @change="(newFilter) => this.filter = newFilter"
        />
        
        <AdminTournamentsTable
            :tournaments="filteredTournaments"
            @select="editTournament"
        />
    </Section>
</template>

<script>
import { storeToRefs } from 'pinia';
import {useTournamentPlatformStore, useTournamentTypeStore, useTournamentStore} from '../../stores/admin';

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