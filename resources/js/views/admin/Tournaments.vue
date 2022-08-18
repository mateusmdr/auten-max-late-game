<template>
    <Section title="Próximos torneios" icon="emoji_events">
        <AdminCreateTournamentModal
            v-if="!selectedTournament"
        />

        <AdminRemoveTournamentModal
            v-else-if="removeMode"
            :tournament="selectedTournament"
            @close="selectedTournament = null;removeMode = false"
        />

        <AdminEditTournamentModal
            v-else
            :tournament="selectedTournament"
            :viewMode="viewMode"
            @close="selectedTournament = null"
            @editMode="viewMode = false"
        />

        <AdminTournamentsFilters
            @change="(newFilter) => this.filter = newFilter"
        />

        <AdminTournamentsTable
            :tournaments="filteredTournaments"
            @select="(tournament) => this.selectedTournament = tournament"
            @editMode="viewMode = false"
            @viewMode="viewMode = true"
            @removeMode="removeMode = true"
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
            viewMode: false,
            removeMode: false
        }
    },
}
</script>
