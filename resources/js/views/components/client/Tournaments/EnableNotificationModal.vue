<template>
	<Modal
        modalTitle= "Ativar"
        modalIcon="alarm_add"
        :titleColor="tournament.is_recurrent ? '#F5A847' : '#05F28E'"
        submitModalText= "Concluir"
        :width="tournament.is_recurrent ? 55 : 30"
        @submit="submit"
        ref="modal"
        noButton
        @close="$emit('close')"
	>
        <div class="row mb-3">
            <div class="col-12 mb-3">
                <h4>Quando você deseja ser notificado?</h4>
            </div>
            <div class="col-12 mb-3">
                <Checkbox
                    label="No início das inscrições"
                    v-model="inputs.before"
                />
            </div>
            <div class="col-12">
                <Checkbox
                    label="Antes do final das inscrições"
                    v-model="inputs.after"
                />
            </div>
            <div class="col-6" v-if="inputs.after">
                <Select
                    :options="notificationIntervals"
                    v-model="inputs.interval"
                />
            </div>
        </div>
        <div v-if="tournament.is_recurrent">
        
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
        const notificationIntervalStore = useNotificationIntervalStore();
        notificationIntervalStore.refresh();
        const tournamentStore = useTournamentStore();
        const {notificationIntervals} = storeToRefs(notificationIntervalStore);

        return {
            notificationIntervals,
            tournamentStore
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
                before: false,
                after: false,
                interval: null
            },
            errors: {
                before: false,
                after: false,
                interval: null
            }
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