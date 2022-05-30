<template>
    <div class="form-container">
        <EditForm
            :showSubmitButton="true"
            title="Dados pessoais"
            submitText="Salvar edições"
            :submitHandler="(e) => {e.preventDefault;}"
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
export default {
    data() {
        return {
            inputs: {
                name: this.user.name,
                cpf: this.user.cpf,
                phone: this.user.phone,
            },
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