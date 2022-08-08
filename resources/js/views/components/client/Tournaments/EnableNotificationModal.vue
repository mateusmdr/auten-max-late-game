<template>
	<Modal
        modalTitle= "Ativar"
        modalIcon="alarm_add"
        :titleColor="tournament.isRecurrent ? '#F5A847' : '#05F28E'"
        submitModalText= "Concluir"
        :width="tournament.isRecurrent ? 55 : 30"
        @submit="submit"
        ref="modal"
        noButton
        @close="$emit('close')"
	>
        <div class="row mb-3">
            <div :class="tournament.isRecurrent ? 'col-6 row align-content-start' : 'col-12 row'">
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
            <div class="col-6 align-content-start" v-if="tournament.isRecurrent">
                <div class="mb-3">
                    <h4>Para quais ocorrências?</h4>
                </div>
                <RadioGroup
                    :options="options"
                    v-model="inputs.option"
                />
                <div v-if="inputs.option === 'custom'" class="row weekdays-container my-3 gy-3">
                    <div class="col-12">
                        <h4>Em quais dias da semana?</h4>
                    </div>
                    <div class="col-4">
                        <Checkbox
                            v-model="inputs.weekDays[0]"
                            label="Domingo"
                        />
                    </div>
                    <div class="col-4">
                        <Checkbox
                            v-model="inputs.weekDays[1]"
                            label="Segunda"
                        />
                    </div>
                    <div class="col-4">
                        <Checkbox
                            v-model="inputs.weekDays[2]"
                            label="Terça"
                        />
                    </div>
                    <div class="col-4">
                        <Checkbox
                            v-model="inputs.weekDays[3]"
                            label="Quarta"
                        />
                    </div>
                    <div class="col-4">
                        <Checkbox
                            v-model="inputs.weekDays[4]"
                            label="Quinta"
                        />
                    </div>
                    <div class="col-4">
                        <Checkbox
                            v-model="inputs.weekDays[5]"
                            label="Sexta"
                        />
                    </div>
                    <div class="col-4">
                        <Checkbox
                            v-model="inputs.weekDays[6]"
                            label="Sábado"
                        />
                    </div>
                </div>
            </div>
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
    created() {
        this.options = [
            {text: 'Todas as ocorrências', value: 'all'},
            {text: 'Apenas esta ocorrência', value: 'one'},
            {text: 'Personalizado', value: 'custom'},
        ]
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
                interval: null,
                weekDays: Array(6).fill(false),
                option: 'one'
            },
            errors: {
                before: null,
                after: null,
                interval: null,
                weekDays: null
            }
        }
    },
    methods: {
        submit() {
            const schedule = this.tournament.isRecurrent ?
                "* * " +
                this.inputs.weekDays
                    .map((item, index) => index)
                    .filter((index) => this.inputs.weekDays[index])
                    .join(',')
                : undefined;

            axios
                .post(`/api/tournament/${this.tournament.id}/notification`, {
                    before: this.inputs.before,
                    after: this.inputs.after,
                    interval: this.inputs.interval ? format(this.inputs.interval, 'HH:mm') : undefined,
                    option: this.tournament.isRecurrent ? this.inputs.option : undefined,
                    schedule
                })
                .then(() => {
                    this.tournamentStore.refresh();
                    this.$emit('close');
                });
        }
    }
}
</script>
