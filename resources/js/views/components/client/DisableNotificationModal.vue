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
        :confirm="!tournament.isRecurrent"
        :noSubmit="!tournament.isRecurrent"
        @close="$emit('close')"
	>
        <div class="row mb-3" v-if="tournament.isRecurrent">
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
        </div>
	</Modal>
</template>

<script>
import {useNotificationStore, useTournamentStore} from '../../../stores/client';

export default {
    emits: ['close'],
    setup() {
        const tournamentStore = useTournamentStore();
        const notificationStore = useNotificationStore();

        return {
            tournamentStore,
            notificationStore
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
                .delete(`/api/tournament/${this.tournament.id}/notification`, {
                    data: {
                        all: this.tournament.isRecurrent ? this.inputs.all : undefined,
                    }
                })
                .then(() => {
                    this.tournamentStore.refresh();
                    this.notificationStore.refresh();
                    this.$emit('close');
                });
        }
    }
}
</script>