<template>
	<Modal
		openModalText="Cadastrar novo torneio"
        modalTitle= "Novo Torneio"
        modalIcon= "emoji_events"
        submitModalText= "Cadastrar"
        :width="55"
        @submit="submit"
        ref="modal"
	>
        <div class="row mb-3">
            <div class="col-4">
                <Checkbox
                    label="Torneio Recorrente"
                    v-model="inputs.is_recurrent"
                />
            </div>
            <div class="col-4">
                <Checkbox
                    v-model="inputs.calculate"
                    label="Cálculo de blinds"
                />
            </div>
            <div class="col-4" v-if="inputs.calculate">
                <Checkbox
                    label="Considerar intervalos"
                    v-model="inputs.hasIntervals"
                />
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
            <div class="col-4">
                <DateInput
                    v-model="inputs.date"
                    label="Data início *"
                />
            </div>
            <div class="col-3">
                <TimeInput
                    label="Início das inscrições *"
                    v-model="inputs.subscription_begin"
                />
            </div>
        </div>

        <div class="row mb-3">
            <template v-if="inputs.calculate">
                <div class="col-4">
                    <NumberInput
                        v-model.number="inputs.blinds"
                        name="Número de blinds *"
                    />
                </div>
                <div class="col-4">
                    <NumberInput
                        v-model.number="inputs.blind_duration"
                        name="Duração de cada blind *"
                        placeholder="Ex: 15 (minutos)"
                    />
                </div>
                <div class="col-3">
                    <DisabledInput
                        :value="subscription_end"
                        name="Fim das inscrições"
                    />
                </div>
            </template>
            <div class="col-3" v-else>
                <TimeInput
                    label="Fim das inscrições *"
                    v-model="inputs.subscription_end"
                />
            </div>
        </div>

        <div class="mt-4" v-if="inputs.is_recurrent">
            <div class="row">
                <div class="col-12 mb-3">
                    <h4>Como funcionará a recorrência?</h4>
                </div>
                <div class="col-12 d-flex flex-row gap-5">
                    <RadioGroup
                        :options="recurrence_types"
                        v-model="inputs.recurrence_type"
                    />
                </div>
            </div>
            <div v-if="inputs.recurrence_type === 'monthly'">
                <h5 class="fw-bold">*O torneio se repetirá mensalmente, a partir do dia do mês informado acima.</h5>
            </div>
            <div class="row weekdays-container gy-3" v-else-if="inputs.recurrence_type === 'weekly' || inputs.recurrence_type === 'biweekly'">
                <div class="col-12">
                    <h4>Quando?</h4>
                </div>
                <div class="col-3">
                    <Checkbox
                        v-model="inputs.weekDays[0]"
                        label="Domingo"
                    />
                </div>
                <div class="col-3">
                    <Checkbox
                        v-model="inputs.weekDays[1]"
                        label="Segunda"
                    />
                </div>
                <div class="col-3">
                    <Checkbox
                        v-model="inputs.weekDays[2]"
                        label="Terça"
                    />
                </div>
                <div class="col-3">
                    <Checkbox
                        v-model="inputs.weekDays[3]"
                        label="Quarta"
                    />
                </div>
                <div class="col-3">
                    <Checkbox
                        v-model="inputs.weekDays[4]"
                        label="Quinta"
                    />
                </div>
                <div class="col-3">
                    <Checkbox
                        v-model="inputs.weekDays[5]"
                        label="Sexta"
                    />
                </div>
                <div class="col-3">
                    <Checkbox
                        v-model="inputs.weekDays[6]"
                        label="Sábado"
                    />
                </div>
            </div>
            <div v-else>
                <h5 class="fw-bold">*O torneio acontecerá todos os dias da semana.</h5>
            </div>
            <div class="mt-3" v-if="inputs.recurrence_type === 'biweekly'">
                <h5 class="fw-bold">*O torneio se repetirá a cada duas semanas, nos dias da semana informados acima (ou a partir da data inicial, caso nenhum tenha sido informado).</h5>
            </div>
            <div class="row mt-4">
                <div class="col-4">
                    <DateInput
                        v-model="inputs.ends_at"
                        label="Data final da recorrência *"
                    />
                </div>
            </div>
        </div>
	</Modal>
</template>

<script>
import {useTournamentTypeStore, useTournamentPlatformStore, useTournamentStore} from '../../../../stores/admin';
import {storeToRefs} from 'pinia';

import moment from 'moment';
import DisabledInput from "../../DisabledInput";
import {format} from "date-format-parse";

export default {
    components: {DisabledInput},
    setup() {
        const tournamentTypeStore = useTournamentTypeStore();
        const tournamentPlatformStore = useTournamentPlatformStore();
        const tournamentStore = useTournamentStore();

        const {tournamentTypes} = storeToRefs(tournamentTypeStore);
        const {tournamentPlatforms} = storeToRefs(tournamentPlatformStore);

        return {
            tournamentTypes,
            tournamentPlatforms,
            tournamentStore
        }
    },
    created() {
        this.recurrence_types = [
            {text: 'Mensal', value: 'monthly'},
            {text: 'Quinzenal', value: 'biweekly'},
            {text: 'Semanal', value: 'weekly'},
            {text: 'Diária', value: 'daily'},
        ]
    },
    data() {
        return {
            inputs: {
                name: null,
                date: null,
                subscription_begin: null,
                subscription_end: null,
                buy_in: null,
                tournamentPlatform: null,
                tournamentType: null,
                is_recurrent: false,
                recurrence_type: 'monthly',
                weekDays: Array(6).fill(false),
                ends_at: null,
                calculate: true,
                blinds: null,
                blind_duration: null,
                hasIntervals: true
            },
            errors: {
                name: null,
                date: null,
                subscription_begin: null,
                subscription_end: null,
                buy_in: null,
                tournament_platform_id: null,
                tournament_type_id: null,
                is_recurrent: false,
                recurrence_type: null,
                weekDays: null,
                ends_at: null
            }
        }
    },
    computed: {
        subscription_end() {
            if(!this.inputs.blinds || !this.inputs.blind_duration) {
                return null;
            }
            const time = moment(this.inputs.subscription_begin, "HH:mm");
            if(this.inputs.hasIntervals){
                for(let c=0; c<this.inputs.blinds; c++) {
                    let h0 = time.hours();
                    time.add(this.inputs.blind_duration, "minutes");
                    let hf = time.hours();

                    if(Math.abs(hf - h0) > 0) { // Houve salto de hora
                        time.add(5, "minutes");
                    }
                }
            }else {
                time.add(this.inputs.blinds * this.inputs.blind_duration, "minutes");
            }

            return time.format("HH:mm");
        }
    },
    methods: {
        getSchedule() {
            let schedule = "0 0 ";
            if(this.inputs.is_recurrent) {
                switch(this.inputs.recurrence_type){
                    case 'daily':
                        schedule += "* * *";
                        break;
                    case 'weekly':
                        schedule += "* * ";
                        schedule += this.inputs.weekDays
                            .map((item, index) => index)
                            .filter((index) => this.inputs.weekDays[index])
                            .join(',');
                        break;
                    case 'biweekly':
                        schedule += "*/15";

                        schedule += " * ";

                        // Days of the week
                        if(this.inputs.weekDays.every(v => !v)) {
                            schedule += (this.inputs.date).getDay();
                        }else {
                            schedule += this.inputs.weekDays
                            .map((item, index) => index)
                            .filter((index) => this.inputs.weekDays[index])
                            .join(',');
                        }

                        break;
                    default:
                        const monthDay = this.inputs.date?.getDate();
                        schedule += monthDay + " * *";
                }
            }

            return schedule;
        },
        submit() {
            axios
                .post('/api/tournament', {
					'name': this.inputs.name,
                    'buy_in': this.inputs.buy_in ? this.inputs.buy_in : undefined,
                    'date': format(this.inputs.date, 'YYYY-MM-DD'),
                    'subscription_begin_at': this.inputs.subscription_begin,
                    'subscription_end_at': this.inputs.calculate ? this.subscription_end : this.inputs.subscription_end,
                    'tournament_platform_id': this.inputs.tournamentPlatform,
                    'tournament_type_id': this.inputs.tournamentType,
                    'is_recurrent': this.inputs.is_recurrent,

                    'schedule': this.inputs.is_recurrent ? this.getSchedule() : undefined,
                    'ends_at': this.inputs.is_recurrent ? format(this.inputs.ends_at, 'YYYY-MM-DD') : undefined,
				})
                .then(this.$refs.modal.closeModal)
				.then(() => {
					this.inputs = {
                        name: null,
                        date: null,
                        subscription_begin: null,
                        subscription_end: null,
                        buy_in: null,
                        tournamentPlatform: null,
                        tournamentType: null,
                        is_recurrent: false,
                        recurrence_type: 'monthly',
                        weekDays: Array(6).fill(false),
                        ends_at: null
                    }
				})
                .catch(res => {this.errors = res.response.data.errors; alert("Verifique os dados inseridos.")})
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
