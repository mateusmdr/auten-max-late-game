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
                this.$emit('change',
                    {
                        tournament_recurrence_id_null: now.tournamentStatus === 3 ? true : undefined,
                        tournament_recurrence_id_present: now.tournamentStatus === 2 ? true : undefined,
                        is_approved_is: now.tournamentStatus === 1 ? false : now.tournamentStatus !== 1 ? true : undefined,
                        date_equals: now.date ? format(now.date, 'DD/MM/YYYY') : undefined,
                        tournament_platform_id_equals: now.tournamentPlatform ? now.tournamentPlatform  : undefined,
                        buy_in_gte: now.minBuyIn ? now.minBuyIn : undefined,
                        buy_in_ste: now.maxBuyIn ? now.maxBuyIn : undefined,
                        tournament_type_id_equals: now.tournamentType ? now.tournamentType : undefined
                    }
                );
            },
            deep: true
        }
    },
    data() {
        return {
            inputs: {
                tournamentStatus: 0,
                date: null,
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
