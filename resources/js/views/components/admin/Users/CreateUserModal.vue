<template>
	<Modal
		openModalText="Cadastrar novo usuário"
        modalTitle= "Novo Usuário"
        modalIcon= "person"
        submitModalText= "Cadastrar"
        @submit="submit"
        width="50vw"
        ref="modal"
	>
        <div class="row mb-3">
            <div class="col-6">
                <TextInput
                    label="Nome *"
                    placeholder="nome completo"
                    v-model="inputs.name"
                    :error-message="errors.name"
                />
            </div>
            <div class="col-6">
                <TextInput
                    label="CPF *"
                    placeholder="000.000.000-00"
                    v-model="inputs.cpf"
                    :error-message="errors.cpf"
                />
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <TextInput
                    label="Telefone *"
                    placeholder="(00) 00000-0000"
                    v-model="inputs.phone"
                    :error-message="errors.phone"
                />
            </div>
            <div class="col-6">
                <EmailInput
                    label="Email *"
                    placeholder="e-mail"
                    v-model="inputs.email"
                    :error-message="errors.email"
                />
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-6">
                <PasswordInput
                    label="Senha *"
                    v-model="inputs.password"
                    :error-message="errors.password"
                />
            </div>
            <div class="col-6">
                <PasswordInput
                    label="Confirmar senha *"
                    v-model="inputs.password_confirmation"
                    :error-message="errors.password_confirmation"
                />
            </div>
        </div>
	</Modal>
</template>

<script>
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
                name: null,
                email: null,
                cpf: null,
                phone: null,
                password: null,
                password_confirmation: null
            },
            errors: {
                name: null,
                email: null,
                cpf: null,
                phone: null,
                password: null,
                password_confirmation: null
            }
        }
    },
    methods: {
        submit() {
            axios
                .post('/api/user', this.inputs)
                .then(this.$refs.modal.closeModal)
                .catch(res => this.errors = res.response.data.errors)
                .finally(this.userStore.refresh);
        }
    }
}
</script>

<style scoped>
</style>