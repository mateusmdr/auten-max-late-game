<template>
    <div class="form-container">
        <div class="mb-4">
            <div class="action-col" @click="blockUser" v-if="!user.isBlocked">
                <icon name="block" color="#EB4263" size="1.5rem"/>
                <h4 style="color: #EB4263;">Bloquear usuário</h4>
            </div>
            <div class="action-col" @click="unblockUser" v-else>
                <icon name="block" color="#B376F8" size="1.5rem"/>
                <h4 style="color:#B376F8;">Desbloquear usuário</h4>
            </div>
            <div class="col-6 mt-3">
                <TextInput
                    label="Motivo do bloqueio *"
                    v-model="blockReason"
                />
            </div>
        </div>
        <EditForm
            :showSubmitButton="hasChanged"
            submitText="Salvar edições"
            @submit="submit"
        >
            <div class="row">
                <div class="col-6 mb-4">
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
                        label="E-mail"
                        v-model="inputs.email"
                    />
                </div>
                <div class="col-6">
                    <TextInput
                        label="Telefone"
                        v-model="inputs.phone"
                    />
                </div>
            </div>
        </EditForm>
    </div>
</template>

<script>
import axios from "axios";
import deepEqual from "deep-equal";

import {useUserStore} from '../../../../stores/admin';

export default {
    setup() {
        const userStore = useUserStore();

        return {
            userStore
        }
    },
    data() {
        return {
            inputs: {
                name: this.user.name,
                cpf: this.user.cpf,
                phone: this.user.phone,
                email: this.user.email,
            },
            blockReason: this.user.block_reason,
        }
    },
    computed: {
        hasChanged() {
            const mapped = {
                name: this.user.name,
                cpf: this.user.cpf,
                phone: this.user.phone,
                email: this.user.email,
            }

            return !deepEqual(this.inputs, mapped);
        }
    },
    methods: {
        submit() {
            const res = confirm("Tem certeza que deseja atualizar os dados deste usuário?");
            if(!res) return;
            axios
                .put('/api/user/' + this.user.id, this.inputs)
                .then(() => this.$emit('update'))
                .catch(() => alert("Verifique os dados inseridos"));
        },
        blockUser() {
            const res = confirm("Tem certeza que deseja bloquear este usuário?");
            if(!res) return;
            axios
                .put('/api/user/' + this.user.id, {
                    is_blocked: true,
                    block_reason: this.blockReason
                })
                .then(() => this.$emit('update'))
                .catch(() => alert("É necessário preencher um motivo para o bloqueio."));
        },
        unblockUser() {
            const res = confirm("Tem certeza que deseja desbloquear este usuário?");
            if(!res) return;
            axios
                .put('/api/user/' + this.user.id, {
                    is_blocked: false
                })
                .then(() => this.$emit('update'))
                .catch(() => alert("Verifique os dados inseridos"));
        }
    },
    emits: ['update'],
    props: {
        user: Object
    }
}
</script>

<style scoped>
    .action-col {
        cursor: pointer;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: flex-start;
    }

    .action-col h4{
        font-weight: 600;
        padding-left: 8px;
        margin: 0;
    }

    .form-container {
        width: max(50vw,850px);
    }
</style>