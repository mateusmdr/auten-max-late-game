<template>
	<Modal
        modalTitle= "Cancelar Torneio"
        titleColor="#EB4263"
        modalIcon= "block"
        submitModalText= "Cancelar"
        :width="55"
        @submit="submit"
        ref="modal"
        :confirm="inputs.all !== null || !tournament.isRecurrent"
        :noSubmit="true"
        @close="$emit('close')"
        noButton
	>
        <div class="row mb-3" v-if="tournament.isRecurrent">
            <div class="col-12 mb-3">
                <h4>Quais torneios deseja cancelar?</h4>
            </div>
            <div class="col-12 mb-3">
                <RadioGroup
                    :options="[
                        {value: false, text: 'Apenas esta ocorrência'},
                        {value: true, text: 'Este e os próximos torneios recorrentes'},
                    ]"
                    v-model="inputs.all"
                />
            </div>
            <div class="col-12 mb-3" v-if="inputs.all">
                <h4>Você tem certeza que deseja cancelar TODAS as ocorrências deste torneio, a partir de {{this.tournament.date}} ?</h4>
            </div>
        </div>
        <div class="row mb-3" v-else>
            <div class="col-12 mb-3">
                <h4>Você tem certeza que deseja cancelar este torneio?</h4>
            </div>
        </div>
	</Modal>
</template>

<script>
import {useTournamentTypeStore, useTournamentPlatformStore, useTournamentStore} from '../../../../stores/admin';
import {storeToRefs} from 'pinia';

import {format} from 'date-format-parse';

export default {
    emits: ['close'],
    props: {
        tournament: Object,
        viewMode: Boolean
    },
    setup() {
        const tournamentStore = useTournamentStore();

        return {
            tournamentStore
        }
    },
    mounted() {
        this.$refs.modal.openModal();
    },
    data() {
        return {
            inputs: {
                all: null
            },
        }
    },
    methods: {
        submit() {
            axios
                .delete(`/api/tournament/${this.tournament.id}${this.inputs.all && '/recurrence'}`)
                .catch(res => {alert("Falha ao cancelar o torneio: " + res.response.data?.errors)})
                .finally(() => {
                    this.tournamentStore.refresh();
                    this.$emit('close');
                });
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
</style>
