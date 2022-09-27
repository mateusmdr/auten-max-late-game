<template>
    <Section title="Próximos torneios" icon="emoji_events">
        <AdminCreateTournamentModal
            v-if="!selectedTournament"
        />

        <AdminRemoveTournamentModal
            v-else-if="removeMode"
            :tournament="selectedTournament"
            @close="selectedTournament = null;removeMode = false; updateTournaments()"
        />

        <AdminEditTournamentModal
            v-else
            :tournament="selectedTournament"
            :viewMode="viewMode"
            @close="selectedTournament = null;updateTournaments()"
            @editMode="viewMode = false"
        />

        <AdminTournamentsFilters
            @change="filters = $event; updateTournaments()"
        />

        <AdminTournamentsTable
            :tournaments="tournaments"
            @select="(tournament) => this.selectedTournament = tournament"
            @editMode="viewMode = false"
            @viewMode="viewMode = true"
            @removeMode="removeMode = true"
            @update="updateTournaments"
        />
        <Paginator @click="qtd += 20;updateTournaments()" :visible="qtd<=tournaments.length"/>
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
            tournaments,
            tournamentStore
        }
    },
    data() {
        return {
            selectedTournament: null,
            viewMode: false,
            removeMode: false,
            qtd: 20,
            filters: {}
        }
    },
    methods: {
        updateTournaments() {
            this.tournamentStore.refresh(this.qtd, this.filters);
        }
    }
}
</script>
