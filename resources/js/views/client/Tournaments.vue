<template>
    <Section title="Próximos torneios" icon="emoji_events">

        <ClientTournamentsFilters
            @change="filters = $event; updateTournaments()"
        />

        <ClientTournamentsTable
            :tournaments="tournaments"
            @select="(tournament) => selectedTournament = tournament"
            @disable="disable = true"
        />
        <Paginator @click="qtd += 7;updateTournaments()" :visible="qtd <= tournaments.length"/>

        <ClientEnableNotificationModal
            v-if="!!selectedTournament && !disable"
            :tournament="selectedTournament"
            @close="selectedTournament = null"
        />

        <ClientDisableNotificationModal
            v-if="disable"
            :tournament="selectedTournament"
            @close="selectedTournament = null; disable = false"
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
            tournaments,
            tournamentStore
        }
    },
    methods: {
        selectTournament(tournament) {
            this.selectedTournament = tournament;
        },
        updateTournaments() {
            this.tournamentStore.refresh(this.qtd, this.filters);
        }
    },
    data() {
        return {
            selectedTournament: null,
            disable: false,
            qtd: 7,
            filters: {}
        }
    },
}
</script>
