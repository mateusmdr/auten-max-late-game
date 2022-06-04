<template>
    <div class="form-container">
        <EditForm
            :showSubmitButton="false"
            title="Tipos de torneio"
            submitText="Salvar edições"
            :submitHandler="(e) => {e.preventDefault;}"
        >
            <div class="row">
                <div class="col-6 mb-3" v-for="tournamentType in tournamentTypes" :key="tournamentType.id">
                    <DisabledInput
                        label=""
                        :value="tournamentType.name"
                        :hasIcon="true"
                        icon="delete"
                        :primary="false"
                        @click="handleDelete(tournamentType)"
                    />
                </div>

                <div class="col-6 mb-3" v-if="confirm">
                    <TextInput
                        name=""
                        v-model="inputs.name"
                        :error-message="errors.name"
                    />
                </div>
            </div>

            <AddButton
                :confirm="confirm"
                @click="handleAddButton"
            />
        </EditForm>
    </div>
</template>

<script>
import { storeToRefs } from 'pinia';
import {useTournamentTypeStore} from '../../../../stores/admin';

export default {
    setup() {
        const tournamentTypeStore = useTournamentTypeStore();
        tournamentTypeStore.refresh();

        const {tournamentTypes} = storeToRefs(tournamentTypeStore);
        return {
            tournamentTypes,
            tournamentTypeStore
        }
    },
    data() {
        return {
            confirm: false,
            inputs: {
                name: null
            },
            errors: {
                name: null
            }
        }
    },
    methods: {
        handleAddButton() {
            if(!this.confirm) {
                this.confirm = true;
                return;
            }

            axios
                .post('/api/tournament_type', {name: this.inputs.name})
                .then(() => {this.inputs.name = null; this.confirm = false})
                .catch(res => this.errors = res.response.data.errors)
                .finally(this.tournamentTypeStore.refresh);
        },
        handleDelete(tournamentType) {
            const res = confirm("Tem certeza que quer remover o tipo \"" + tournamentType.name + "\" ?");

            if(!res) {
                return;
            }

            axios
                .delete('/api/tournament_type/' + tournamentType.id)
                .catch(res => alert(res.response.data.errors[0]))
                .finally(this.tournamentTypeStore.refresh);
        }
    }
}
</script>

<style scoped>
    .form-container {
        width: 35vw;
    }
</style>