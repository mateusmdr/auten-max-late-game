<template>
    <Section title="Próximos torneios" icon="emoji_events">
        <div class="absolute-top-right">
            <DynamicButton text="Cadastrar novo torneio"/>
        </div>

        <RadioChips
            :chips="chips"
            :selectedIndex="selectedIndex"
            :setIndex="(index) => {selectedIndex = index}"
        />
        <div class="input-container my-5">
            <div class="row">
                <div class="col-1">
                    <Datepicker :value="date" @input="(val) => date=val"/>
                </div>
                <div class="col-1">
                    <Timepicker :value="time" @input="(val) => time=val"/>
                </div>
                <div class="col-2">
                    <Select 
                        :options="platforms"
                        :value="platform"
                        @input="(val) => platform=val"
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
                        :value="tournamentType"
                        @input="(val) => tournamentType=val"
                        name="Tipo de torneio"
                    />
                </div>
            </div>            
        </div>

        <Table
            defaultActionIcon='add'
            defaultActionText='Ver mais'
            :fields="[
                {name: 'Dia', width: 1},
                {name: 'Inscrição', width: 2},
                {name: 'Plataforma', width: 2},
                {name: 'Tipo torneio', width: 1},
                {name: 'Buy-in Mín', width: 1},
                {name: 'Buy-in Máx', width: 1},
                {name: 'Recorrência', width: 1}
            ]"
            :items="tournaments"
        />
    </Section>
</template>

<script>
    import Section from '../components/Section.vue';
    import DynamicButton from '../components/DynamicButton.vue';
    import Table from '../components/Table.vue';
    import RadioChips from '../components/RadioChips.vue';
    
    import Datepicker from '../components/Datepicker.vue';
    import Timepicker from '../components/Timepicker.vue';
    import NumberInput from '../components/NumberInput.vue';
    import Select from '../components/Select.vue';

    export default {
        components: {
            Datepicker,
            Timepicker,
            Section,
            DynamicButton,
            Table,
            RadioChips,
            NumberInput,
            Select
        },
        data() {
            return {
                selectedIndex: 0,
                date: new Date(),
                time: new Date(),
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
                chips: [
                    {
                        text:'Todos',
                        hasIcon: false,
                    },
                    {
                        text:'Em aprovação',
                        color:'#EB4263',
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
                ).concat(Array(4).fill(
                    {
                        id: 1,
                        title: 'Título do torneio',
                        color: '#EB4263',
                        values: [
                            '00/00/0000',
                            '00h00 às 00h00',
                            'Party Poker',
                            'Cash Game',
                            '$ 0000,00',
                            '$ 000000,00',
                            'R$ 00000,00'
                        ],
                        isEditable: true,
                        actions: {
                            delete: () => console.log('Deletar'),
                            edit: () => console.log('Editar'),
                            approve: () => console.log('Aprovar'),
                        }
                    }
                ))
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