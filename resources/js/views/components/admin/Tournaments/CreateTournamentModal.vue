<template>
	<Modal
		openModalText="Cadastrar novo torneio"
        modalTitle= "Novo Torneio"
        modalIcon= "emoji_events"
        submitModalText= "Cadastrar"
        :submitModal="() => true"
        width="55vw"
	>
        <div class="row mb-3">
            <div class="col-4">
                <TextInput
                    label="Nome *"
                    placeholder="Nome do torneio"
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
            <div class="col-3">
                <NumberInput 
                    v-model.number="inputs.prize"
                    name="Prêmio *"
                />
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-2">
                <DateInput 
                    v-model="inputs.date"
                    label="Data início *"
                />
            </div>
            <div class="col-2">
                <TimeInput 
                    label="Inscrição *"
                    v-model="inputs.subscription_begin"
                />
            </div>
            <div class="col-1 d-flex justify-content-center align-items-center flex-column">
                <span class="mt-3">às</span>
            </div>
            <div class="col-2">
                <TimeInput 
                    label=""
                    v-model="inputs.subscription_end"
                />
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <Checkbox
                    label="Torneio Recorrente"
                    v-model="inputs.isRecurrent"
                />
            </div>
        </div>

        <div class="mt-4" v-if="inputs.isRecurrent">
            <h4>Como funcionará a recorrência?</h4>
            <div class="row my-3">
                <div class="col-4">
                    
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <DateInput 
                        v-model="inputs.date"
                        label="Data final da recorrência *"
                    />
                </div>
            </div>
        </div>
	</Modal>
</template>

<script>
import {useTournamentTypeStore, useTournamentPlatformStore} from '../../../../stores/admin';
import {storeToRefs} from 'pinia';

export default {
    setup() {
        const tournamentTypeStore = useTournamentTypeStore();
        const tournamentPlatformStore = useTournamentPlatformStore();

        const {tournamentTypes} = storeToRefs(tournamentTypeStore);
        const {tournamentPlatforms} = storeToRefs(tournamentPlatformStore);

        return {
            tournamentTypes,
            tournamentPlatforms
        }
    },
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
    data() {
        return {
            inputs: {
                date: null,
                time: null,
                minBuyIn: null,
                maxBuyIn: null,
                tournamentPlatform: null,
                tournamentType: null,
                isRecurrent: false
            }
        }
    }
}
</script>

<style scoped>
    
</style>