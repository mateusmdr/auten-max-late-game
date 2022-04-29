<template>
    <RadioChips
        :chips="tournamentStatuses"
        v-model="tournamentStatus"
    />
    <div class="input-container my-5">
        <div class="row">
            <div class="col-1">
                <DateInput v-model="inputs.date"/>
            </div>
            <div class="col-1">
                <TimeInput v-model="inputs.time"/>
            </div>
            <div class="col-2">
                <Select 
                    :options="platforms"
                    v-model="inputs.platform"
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
export default {
    created() {
        this.platforms = [
            {
                name: 'Party Poker',
                value: 0
            },
            {
                name: 'Pokerstars',
                value: 1
            },
            {
                name: 'WPN',
                value: 2
            },
        ];

        this.tournamentTypes = [
            {
                name: 'Tipo 1',
                value: 0
            },
            {
                name: 'Tipo 2',
                value: 1
            },
            {
                name: 'Tipo 3',
                value: 2
            },
        ];

        this.tournamentStatuses = [
            {
                text:'Todos',
                hasIcon: false,
            },
            {
                text:'Notificação ativada',
                color:'#B376F8',
            },
            {
                text:'Recorrentes',
                color:'#F5A847',
            },
            {
                text:'Não Recorrentes',
                color:'#05F28E',
            }
        ];
    },
    data() {
        return {
            tournamentStatus: 0,
            inputs: {
                date: null,
                time: null,
                minBuyIn: null,
                maxBuyIn: null,
                platform: null,
                tournamentType: null,
            },
        }
    }
}
</script>

<style>

</style>