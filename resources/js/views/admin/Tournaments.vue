<template>
    <Section title="Próximos torneios" icon="emoji_events">
        <CreateTournamentModal
            v-model="showModal"
        />

        <RadioChips
            :chips="tournamentStatuses"
            :value="tournamentStatusId"
            @input="(id) => {tournamentStatusId = id}"
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
            defaultActionIcon='add'
            defaultActionText='Ver mais'
            :fields="tournamentFields"
            :items="tournaments"
        />
    </Section>
</template>

<script>
    export default {
        data() {
            return {
                showModal: false,
                tournamentStatusId: 0,
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
                ],
                tournamentFields : [
                    {name: 'Dia', width: 1},
                    {name: 'Inscrição', width: 2},
                    {name: 'Plataforma', width: 2},
                    {name: 'Tipo torneio', width: 1},
                    {name: 'Buy-in Mín', width: 1},
                    {name: 'Buy-in Máx', width: 1},
                    {name: 'Prêmio', width: 1}
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
                            '0000',
                            '0000',
                            '0000'
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
                            '0000',
                            '0000',
                            '0000'
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