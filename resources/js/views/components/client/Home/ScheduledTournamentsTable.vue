<template>
    <Section title="Agenda de hoje" description="Próximos torneios" icon="date_range" v-if="enabledTournaments.length !== 0">
        <Table
            defaultActionIcon='alarm_off'
            defaultActionText='Desativar'
            :fields="fields"
            :items="enabledTournaments"
            :colorPicker="(item) => '#B376F8'"
            :action="(item) => selectedTournament = item"
        />
    </Section>
    <ClientDisableNotificationModal
        v-if="!!selectedTournament"
        :tournament="selectedTournament"
        @close="selectedTournament = null"
    />
</template>

<script>
import { storeToRefs } from 'pinia';
import {useTournamentStore} from '../../../../stores/client';

export default {
    setup() {
        const tournamentStore = useTournamentStore();
        tournamentStore.refresh();

        const {enabledTournaments} = storeToRefs(tournamentStore);
        return {
            tournamentStore,
            enabledTournaments
        }
    },
    created() {
        this.fields = [
            {name: '', value: 'name', width: 2},
            {name: 'Dia', value: 'date', width: 1},
            {name: 'Inscrição', value: 'subscription', width: 2},
            {name: 'Plataforma', value: 'platform_name', width: 2},
            {name: 'Tipo torneio', value: 'type_name', width: 2},
            {name: 'Buy-in', value: 'buy_in', width: 1},
            {name: 'Prêmio', value: 'prize', width: 1}
        ];
    },
    data() {
        return {
            selectedTournament: null
        }
    }
}
</script>