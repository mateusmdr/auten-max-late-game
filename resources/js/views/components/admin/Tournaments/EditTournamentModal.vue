<template>
	<Modal
        :modalTitle="viewMode ? 'Torneio' : 'Editar Torneio'"
        :modalIcon="viewMode ? 'emoji_events' : 'edit'"
        :titleColor="viewMode ? '#05F28E' : '#B376F8'"
        submitModalText= "Salvar"
        :width="55"
        @submit="submit"
        ref="modal"
        noButton
        @close="$emit('close')"
        :noSubmit="viewMode"
        :isLoading="isLoading"
	>
        <div class="d-flex flex-row mb-3" v-if="viewMode">
            <div class="action-col me-4" @click="$emit('editMode')">
                <icon name="edit" color="#B376F8" size="1.5rem"/>
                <h4 style="color: #B376F8;">Editar torneio</h4>
            </div>
            <div class="action-col" @click="deleteTournament">
                <icon name="block" color="#EB4263" size="1.5rem"/>
                <h4 style="color:#EB4263;">Cancelar torneio</h4>
            </div>
        </div>
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
            <div class="col-4">
                <NumberInput
                    v-model.number="inputs.buy_in"
                    :integer="false"
                    name="Buy-in"
                />
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-3">
                <DateInput
                    v-model="inputs.date"
                    label="Data início *"
                />
            </div>
            <div class="col-3">
                <TimeInput
                    label="Inscrição *"
                    v-model="inputs.subscription_begin"
                />
            </div>
            <div class="col-1 d-flex justify-content-center align-items-center flex-column">
                <span class="mt-3">às</span>
            </div>
            <div class="col-3">
                <TimeInput
                    label=""
                    v-model="inputs.subscription_end"
                />
            </div>
        </div>
	</Modal>
</template>

<script>
import {useTournamentTypeStore, useTournamentPlatformStore} from '../../../../stores/admin';
import {storeToRefs} from 'pinia';

import { parse, format } from 'date-format-parse';

export default {
    emits: ['close', 'editMode'],
    setup(context, props) {
        const tournamentTypeStore = useTournamentTypeStore();
        const tournamentPlatformStore = useTournamentPlatformStore();

        const {tournamentTypes} = storeToRefs(tournamentTypeStore);
        const {tournamentPlatforms} = storeToRefs(tournamentPlatformStore);

        return {
            tournamentTypes,
            tournamentPlatforms,
        }
    },
    props: {
        tournament: Object,
        viewMode: Boolean
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
            isLoading: false,
            inputs: {
                name: this.tournament.name,
                date: parse(this.tournament.date, 'DD/MM/YYYY'),
                subscription_begin: this.subscription[0],
                subscription_end: this.subscription[2],
                buy_in: this.tournament.buy_in,
                tournamentPlatform: this.tournament.platform_id,
                tournamentType: this.tournament.type_id,
            },
            errors: {
                name: null,
                date: null,
                subscription_begin: null,
                subscription_end: null,
                buy_in: null,
                tournament_platform_id: null,
                tournament_type_id: null,
            }
        }
    },
    methods: {
        submit() {
            this.isLoading = true;
            axios
                .put(`/api/tournament/${this.tournament.id}`, {
					'name': this.inputs.name,
                    'buy_in': this.inputs.buy_in,
                    'date': format(this.inputs.date, 'YYYY-MM-DD'),
                    'subscription_begin_at': this.inputs.subscription_begin,
                    'subscription_end_at': this.inputs.subscription_end,
                    'tournament_platform_id': this.inputs.tournamentPlatform,
                    'tournament_type_id': this.inputs.tournamentType,
				})
                .then(() => this.$emit('close'))
                .catch(res => this.errors = res.response.data.errors)
                .finally(() => {
                    this.isLoading = false;
                    this.$refs.modal.closeModal();
                });
        },
        deleteTournament() {
            let res;
            if(this.tournament.isRecurrent) {
                res = confirm("Tem certeza que deseja cancelar esta ocorrência de torneio?");
            }else {
                res = confirm("Tem certeza que deseja cancelar este torneio?");
            }

            if(res) {
                this.isLoading = true;
                axios
                    .delete(`/api/tournament/${this.tournament.id}`)
                    .catch(res => {alert("Falha ao cancelar o torneio: " + res.response.data?.errors)})
                    .finally(() => {
                        this.isLoading = false;
                        this.$refs.modal.closeModal();
                    });
            }
        },
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

    .action-col {
        cursor: pointer;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: flex-start;
    }

    .action-col h4{
        font-weight: 600;
        padding-left: 8px;
        margin: 0;
    }
</style>
