<template>
	<Modal
        modalTitle= "Editar Torneio"
        modalIcon="edit"
        titleColor="#B376F8"
        submitModalText= "Salvar"
        :width="55"
        @submit="submit"
        ref="modal"
        noButton
        @close="$emit('close')"
	>
        <div class="row mb-3">
            <div class="col-4">
                <TextInput
                    label="Nome *"
                    placeholder="Nome do torneio"
                    v-model="inputs.name"
                />
            </div>
            <div class="col-4">
                <Select 
                    :options="tournamentPlatforms"
                    v-model="inputs.tournamentPlatform"
                    name="Plataforma *"
                />
            </div>
            <div class="col-4">
                <Select 
                    :options="tournamentTypes"
                    v-model="inputs.tournamentType"
                    name="Tipo de torneio *"
                />
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-2">
                <NumberInput 
                    v-model.number="inputs.min_buy_in"
                    name="Buy-in mínimo"
                />
            </div>
            <div class="col-2">
                <NumberInput 
                    v-model.number="inputs.max_buy_in"
                    name="Buy-in máximo"
                />
            </div>
            <div class="col-3">
                <NumberInput 
                    v-model.number="inputs.prize"
                    name="Prêmio *"
                />
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-2">
                <DateInput 
                    v-model="inputs.date"
                    label="Data início *"
                />
            </div>
            <div class="col-2">
                <TimeInput 
                    label="Inscrição *"
                    v-model="inputs.subscription_begin"
                />
            </div>
            <div class="col-1 d-flex justify-content-center align-items-center flex-column">
                <span class="mt-3">às</span>
            </div>
            <div class="col-2">
                <TimeInput 
                    label=""
                    v-model="inputs.subscription_end"
                />
            </div>
        </div>
	</Modal>
</template>

<script>
import {useTournamentTypeStore, useTournamentPlatformStore, useTournamentStore} from '../../../../stores/admin';
import {storeToRefs} from 'pinia';

import { parse, format } from 'date-format-parse';

export default {
    emits: ['close'],
    setup(context, props) {
        const tournamentTypeStore = useTournamentTypeStore();
        const tournamentPlatformStore = useTournamentPlatformStore();
        const tournamentStore = useTournamentStore();

        const {tournamentTypes} = storeToRefs(tournamentTypeStore);
        const {tournamentPlatforms} = storeToRefs(tournamentPlatformStore);

        return {
            tournamentTypes,
            tournamentPlatforms,
            tournamentStore,
        }
    },
    props: {
        tournament: Object
    },
    mounted() {
		this.$refs.modal.openModal();
	},
    created() {
        this.recurrence_types = [
            {text: 'Mensal', value: 'monthly'},
            {text: 'Quinzenal', value: 'biweekly'},
            {text: 'Semanal', value: 'weekly'},
            {text: 'Diária', value: 'daily'},
        ];
    },
    data() {
        this.subscription = this.tournament.subscription.split(' ');

        return {
            inputs: {
                name: this.tournament.name,
                date: parse(this.tournament.date, 'DD/MM/YYYY'),
                subscription_begin: parse(this.subscription[0],'HH:mm'),
                subscription_end: parse(this.subscription[2],'HH:mm'),
                prize: this.tournament.prize,
                min_buy_in: this.tournament.min,
                max_buy_in: this.tournament.max,
                tournamentPlatform: this.tournament.platform_id,
                tournamentType: this.tournament.type_id,
                // is_recurrent: false,
                // recurrence_type: 'monthly',
                // weekDays: Array(6).fill(false),
                // ends_at: null
            },
            errors: {
                name: null,
                date: null,
                subscription_begin: null,
                subscription_end: null,
                prize: null,
                min_buy_in: null,
                max_buy_in: null,
                tournament_platform_id: null,
                tournament_type_id: null,
            }
        }
    },
    methods: {
        submit() {
            const subscription_begin = this.$func.toUTC(this.inputs.subscription_begin);
            const subscription_end = this.$func.toUTC(this.inputs.subscription_end);
            axios
                .put(`/api/tournament/${this.tournament.id}`, {
					'name': this.inputs.name,
                    'prize': this.inputs.prize,
                    'min_buy_in': this.inputs.min_buy_in,
                    'max_buy_in': this.inputs.max_buy_in,
                    'date': format(this.inputs.date, 'YYYY-MM-DD'),
                    'subscription_begin_at': format(subscription_begin, 'HH:mm'),
                    'subscription_end_at': format(subscription_end, 'HH:mm'),
                    'tournament_platform_id': this.inputs.tournamentPlatform,
                    'tournament_type_id': this.inputs.tournamentType,
				})
                .then(() => this.$emit('close'))
                .catch(res => this.errors = res.response.data.errors)
                .finally(this.tournamentStore.refresh);
        }
    }
}
</script>

<style scoped>
    h4 {
        font-weight: 400;
        color: #E2E2FF;
    }

    h5 {
        color: #E2E2FF;
    }

    .weekdays-container {
        width: 60%;
    }
</style>