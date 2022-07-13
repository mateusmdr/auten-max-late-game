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
            <div class="col-6 mt-4" v-if="inputs.after">
                <TimeInput
                    v-model="inputs.interval"
                    :default="this.end"
                />
            </div>
        </div>
        <div v-if="tournament.is_recurrent">
        
        </div>
	</Modal>
</template>

<script>
import {useTournamentStore} from '../../../../stores/client';
import {parse, format} from 'date-format-parse';

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

        this.subscription = this.tournament.subscription.split(' ');
        this.begin = parse(this.subscription[0], 'HH:mm');
        this.end = parse(this.subscription[2], 'HH:mm');
	},
    data() {
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
                    interval: this.inputs.interval ? format(this.inputs.interval, 'HH:mm') : undefined,
                })
                .then(() => {
                    this.tournamentStore.refresh();
                    this.$emit('close');
                });
        }
    }
}
</script>

<style>
.v-select {
    --vs-controls-color: #BFC9DB;
    --vs-border-color: #333333;

    --vs-dropdown-bg: #3E3E3E;
    --vs-dropdown-color: #F2F5FA;
    --vs-dropdown-option-color: #F2F5FA;

    --vs-selected-bg: #333333;
    --vs-selected-color: #F2F5FA;

    --vs-search-input-color: #F2F5FA;

    --vs-dropdown-option--active-bg: #333333;
    --vs-dropdown-option--active-color: #F2F5FA;
}

.v-select .vs__dropdown-toggle {
    height: 3rem;
    border-radius: .5rem;
    width: 100%;
    border: 0;
    margin-bottom: 0;

    background-color: #4F4F4F;
    color: #BFC9DB;
    padding: 0 1rem;
    box-sizing: border-box;
}

.v-select .vs__selected-options {
    align-items: center;
}

</style>