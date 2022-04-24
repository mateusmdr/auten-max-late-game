<template>
    <Section title="Próximos torneios" icon="emoji_events">
        <div class="absolute-top-right">
            <DynamicButton text="Cadastrar novo torneio"/>
        </div>

        <RadioChips
            :chips="tournamentStatuses"
            :selectedIndex="tournamentStatusIndex"
            :setIndex="(index) => {tournamentStatusIndex = index}"
        />
        <div class="input-container my-5">
            <div class="row">
                <div class="col-1">
                    <DateInput v-model="date"/>
                </div>
                <div class="col-1">
                    <TimeInput v-model="time"/>
                </div>
                <div class="col-2">
                    <Select 
                        :options="platforms"
                        v-model="platform"
                        name="Plataforma"
                    />
                </div>
                <div class="col-2">
                    <NumberInput 
                        v-model.number="minBuyIn"
                        name="Buy-in mínimo"
                    />
                </div>
                <div class="col-2">
                    <NumberInput 
                        v-model.number="maxBuyIn"
                        name="Buy-in máximo"
                    />
                </div>
                <div class="col-2">
                    <Select 
                        :options="tournamentTypes"
                        v-model="tournamentType"
                        name="Tipo de torneio"
                    />
                </div>
            </div>            
        </div>

        <Table
            defaultActionIcon='alarm_add'
            defaultActionText='Ativar'
            :fields="tournamentFields"
            :items="tournaments"
        />
    </Section>
</template>

<script>
    import Section from '../components/Section.vue';
    import DynamicButton from '../components/DynamicButton.vue';
    import Table from '../components/Table.vue';
    import RadioChips from '../components/RadioChips.vue';
    
    import DateInput from '../components/DateInput.vue';
    import TimeInput from '../components/TimeInput.vue';
    import NumberInput from '../components/NumberInput.vue';
    import Select from '../components/Select.vue';

    export default {
        components: {
            DateInput,
            TimeInput,
            Section,
            DynamicButton,
            Table,
            RadioChips,
            NumberInput,
            Select
        },
        data() {
            return {
                tournamentStatusIndex: 0,
                date: null,
                time: null,
                minBuyIn: null,
                maxBuyIn: null,
                platform: null,
                platforms: [
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
                ],
                tournamentType: null,
                tournamentTypes: [
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
                ],
                tournamentStatuses: [
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
                ],
                tournamentFields : [
                    {name: 'Dia', width: 1},
                    {name: 'Inscrição', width: 2},
                    {name: 'Plataforma', width: 2},
                    {name: 'Tipo torneio', width: 1},
                    {name: 'Buy-in Mín', width: 1},
                    {name: 'Buy-in Máx', width: 1},
                    {name: 'Recorrência', width: 1}
                ],
                tournaments: Array(4).fill(
                    {
                        id: 1,
                        title: 'Título do torneio',
                        color: '#05F28E',
                        values: [
                            '00/00/0000',
                            '00h00 às 00h00',
                            'Party Poker',
                            'Cash Game',
                            '$ 0000,00',
                            '$ 000000,00',
                            'R$ 00000,00'
                        ],
                        isEditable: false,
                        defaultAction: () => console.log("fui clicado")
                    }
                )
            }
        }
    }
</script>

<style scoped>
    .img-home {
        width: 7vw;
        height: auto;
    }
</style>