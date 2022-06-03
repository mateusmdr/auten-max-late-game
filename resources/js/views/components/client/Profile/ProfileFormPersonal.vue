<template>
    <div class="form-container">
        <EditForm
            :showSubmitButton="hasChanged"
            title="Dados pessoais"
            submitText="Salvar edições"
            @submit="submit"
        >
            <div class="row">
                <div class="col-12 mb-4">
                    <TextInput
                        label="Nome"
                        v-model="inputs.name"
                    />
                </div>
                <div class="col-6">
                    <TextInput
                        label="CPF"
                        v-model="inputs.cpf"
                    />
                </div>
                <div class="col-6">
                    <TextInput
                        label="Telefone"
                        v-model="inputs.phone"
                    />
                </div>
            </div>
            <div class="text-end mt-2">
                <a class="change-password-link align-self-end" href="/password/reset">Alterar senha</a>
            </div>
        </EditForm>
    </div>
</template>

<script>
import axios from "axios";
import deepEqual from "deep-equal";
import { storeToRefs } from "pinia";

import {useCurrentUserStore} from '../../../../stores/client';

export default {
    setup() {
        const currentUserStore = useCurrentUserStore();

        const {user} = storeToRefs(currentUserStore);

        return {
            currentUser: user,
            currentUserStore
        }
    },
    data() {
        return {
            inputs: {
                name: this.currentUser.name,
                cpf: this.currentUser.cpf,
                phone: this.currentUser.phone,
            },
        }
    },
    computed: {
        hasChanged() {
            const mapped = {
                name: this.currentUser.name,
                cpf: this.currentUser.cpf,
                phone: this.currentUser.phone,
            }

            return !deepEqual(this.inputs, mapped);
        }
    },
    methods: {
        submit() {
            axios
                .put('/api/user/' + this.currentUser.id, this.inputs)
                .then(() => this.currentUserStore.refresh())
                .catch(() => alert("Verifique os dados inseridos"));
        }
    }
}
</script>

<style scoped>
    .change-password-link {
        text-decoration: none;
        color: #BFC9DB;
        font-weight: 600;
        transition: .2s;
    }

    .change-password-link:hover {
        color: white;
    }

    .form-container {
        width: max(50vw,850px);
    }
</style>