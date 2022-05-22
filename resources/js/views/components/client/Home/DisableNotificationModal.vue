<template>
	<Modal
        modalTitle= "Desativar"
        modalIcon="alarm_off"
        titleColor="#B376F8"
        submitModalText= "Concluir"
        :width="30"
        @submit="submit"
        ref="modal"
        noButton
        :noSubmit="!tournament.is_recurrent"
        @close="$emit('close')"
	>
        <div class="row mb-3" v-if="tournament.is_recurrent">
            <div class="col-12 mb-3">
                <h4>Como você deseja desativar a notificação deste torneio?</h4>
            </div>
            <div class="col-12 mb-3">
                <RadioGroup
                    :options="[
                        {value: false, text: 'Cancelar apenas este evento'},
                        {value: true, text: 'Todos os eventos recorrentes'},
                    ]"
                    v-model="inputs.all"
                />
            </div>
        </div>
        <div class="row mb-3" v-else>
            <div class="col-12 mb-3">
                <h4>Você tem certeza que deseja cancelar a notificação deste torneio?</h4>
            </div>
            <div class="col-6">
                Sim
            </div>
            <div class="col-6">
                Não
            </div>
        </div>
	</Modal>
</template>

<script>
import {useNotificationIntervalStore, useTournamentStore} from '../../../../stores/client';
import {storeToRefs} from 'pinia';

import { parse, format } from 'date-format-parse';

export default {
    emits: ['close'],
    setup() {
        const tournamentStore = useTournamentStore();

        return {
            tournamentStore
        }
    },
    props: {
        tournament: Object
    },
    mounted() {
		this.$refs.modal.openModal();
	},
    data() {
        this.subscription = this.tournament.subscription.split(' ');

        return {
            inputs: {
                all: false
            },
        }
    },
    methods: {
        submit() {
            axios
                .post(`/api/tournament/${this.tournament.id}/notification`, {
                    before: this.inputs.before,
                    after: this.inputs.after,
                    interval: this.inputs.interval ? this.inputs.interval : undefined,
                })
                .then(() => {
                    this.tournamentStore.refresh();
                    this.$emit('close');
                });
        }
    }
}
</script>