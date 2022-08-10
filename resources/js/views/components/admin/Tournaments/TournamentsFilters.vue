<template>
    <RadioChips
        :chips="tournamentStatuses"
        v-model="inputs.tournamentStatus"
    />

    <div class="input-container my-5">
        <div class="row">
            <div class="col-2">
                <DateInput v-model="inputs.date"/>
            </div>
            <div class="col-2">
                <TimeInput v-model="inputs.time"/>
            </div>
            <div class="col-2">
                <Select
                    :options="tournamentPlatforms"
                    v-model="inputs.tournamentPlatform"
                    name="Plataforma"
                />
            </div>
            <div class="col-2">
                <NumberInput
                    v-model.number="inputs.minBuyIn"
                    name="Buy-in mínimo"
                />
            </div>
            <div class="col-2">
                <NumberInput
                    v-model.number="inputs.maxBuyIn"
                    name="Buy-in máximo"
                />
            </div>
            <div class="col-2">
                <Select
                    :options="tournamentTypes"
                    v-model="inputs.tournamentType"
                    name="Tipo de torneio"
                />
            </div>
        </div>
    </div>
</template>

<script>
import {useTournamentTypeStore, useTournamentPlatformStore} from '../../../../stores/admin';
import {storeToRefs} from 'pinia';

import {parse, format} from 'date-format-parse';

export default {
    setup() {
        const tournamentTypeStore = useTournamentTypeStore();
        const tournamentPlatformStore = useTournamentPlatformStore();
        tournamentTypeStore.refresh();
        tournamentPlatformStore.refresh();

        const {tournamentTypes} = storeToRefs(tournamentTypeStore);
        const {tournamentPlatforms} = storeToRefs(tournamentPlatformStore);

        return {
            tournamentTypes,
            tournamentPlatforms
        }
    },
    emits: ['change'],
    created() {
        this.tournamentStatuses = [
            {
                id: 0,
                text:'Todos',
                hasIcon: false,
            },
            {
                id: 1,
                text:'Em aprovação',
                color:'#EB4263',
            },
            {
                id: 2,
                text:'Recorrentes',
                color:'#F5A847',
            },
            {
                id: 3,
                text:'Não Recorrentes',
                color:'#05F28E',
            }
        ];
    },
    watch: {
        inputs: {
            handler(before, now) {
                const newFilter = (tournament) => {
                    const subscription = tournament.subscription.split(' ');
                    const begin = parse(subscription[0], 'HH:mm');
                    const end = parse(subscription[2], 'HH:mm');

                    let tournamentStatusFilter = true;
                    switch(now.tournamentStatus) {
                        case 1:
                            tournamentStatusFilter = !tournament.isApproved;
                            break;
                        case 2:
                            tournamentStatusFilter = tournament.isApproved && tournament.isRecurrent;
                            break;
                        case 3:
                            tournamentStatusFilter = tournament.isApproved && !tournament.isRecurrent;
                    }

                    const buyIn = Number(tournament.buy_in.toString().replace(',','.'));

                    return (
                        tournamentStatusFilter &&
                        (now.date ? tournament.date === format(now.date, 'DD/MM/YYYY') : true) &&
                        (now.time ? (now.time <= end && now.time >= begin) : true) &&
                        (now.tournamentPlatform ? tournament.platform_id == now.tournamentPlatform : true) &&
                        (now.minBuyIn ? (now.minBuyIn <= buyIn) : true) &&
                        (now.maxBuyIn ? (now.maxBuyIn >= buyIn) : true) &&
                        (now.tournamentType ? tournament.type_id == now.tournamentType : true)
                    );
                };

                this.$emit('change',newFilter);
            },
            deep: true
        }
    },
    data() {
        return {
            inputs: {
                tournamentStatus: 0,
                date: null,
                time: null,
                minBuyIn: null,
                maxBuyIn: null,
                tournamentPlatform: null,
                tournamentType: null,
            }
        }
    }
}
</script>

<style>

</style>
