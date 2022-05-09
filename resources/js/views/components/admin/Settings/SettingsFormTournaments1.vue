<template>
    <div class="form-container">
        <EditForm
            :showSubmitButton="false"
            title="Plataformas"
            submitText="Salvar edições"
        >
            <div class="row">
                <div class="col-12 mb-3" v-for="tournamentPlatform, index in tournamentPlatforms" :key="tournamentPlatform.id">
                    <DisabledInput
                        label=""
                        :value="tournamentPlatform.name"
                        :hasIcon="true"
                        icon="delete"
                        :primary="false"
                        @click="handleDelete(tournamentPlatform)"
                    />
                </div>

                <div class="col-5 mb-3" v-if="confirm">
                    <TextInput
                        name="Nome *"
                        v-model="inputs.name"
                        :error-message="errors.name"
                    />
                </div>
                <div class="col-7 mb-3" v-if="confirm">
                    <FileInput
                        name="Imagem *"
                        @change="(img) => inputs.img = img"
                        hint="Insira uma imagem em .png ou .jpg"
                        :error-message="errors.img"
                        mime="image/jpeg,image/png"
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
import {useTournamentPlatformStore} from '../../../../stores/admin';

export default {
    setup() {
        const tournamentPlatformStore = useTournamentPlatformStore();
        tournamentPlatformStore.refresh();

        const {tournamentPlatforms} = storeToRefs(tournamentPlatformStore);
        return {
            tournamentPlatforms,
            tournamentPlatformStore
        }
    },
    data() {
        return {
            confirm: false,
            inputs: {
                name: null,
                img: null
            },
            errors: {
                name: null,
                img: null
            }
        }
    },
    methods: {
        handleAddButton() {
            if(!this.confirm) {
                this.confirm = true;
                return;
            }
            
            const formData = new FormData();
            formData.append('img', this.inputs.img);
            formData.append('name', this.inputs.name);

            axios
                .post(
                    '/api/tournament_platform',
                    formData,
					{
						headers: {
							'Content-Type': 'multipart/form-data'
						}
					}
                )
                .then(() => {
                    this.inputs = {
                        name: null,
                        img: null
                    };
                    this.confirm = false;
                })
                .catch(res => this.errors = res.response.data.errors)
                .finally(this.tournamentPlatformStore.refresh);
        },
        handleDelete(tournamentPlatform) {
            const res = confirm("Tem certeza que quer remover o tipo \"" + tournamentPlatform.name + "\" ?");

            if(!res) {
                return;
            }

            axios
                .delete('/api/tournament_platform/' + tournamentPlatform.id)
                .catch(res => alert(res.response.data.errors[0]))
                .finally(this.tournamentPlatformStore.refresh);
        }
    }
}
</script>

<style scoped>
    .form-container {
        width: 30vw;
    }
</style>