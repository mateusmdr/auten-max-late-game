<template>
    <Section title="Perfil" icon="person">
        <h1 class="mb-5">* Dados pessoais</h1>

        <div class="form-1">
            <EditForm
                :showSubmitButton="true"
                title="Dados pessoais"
                submitText="Salvar edições"
                :submitHandler="(e) => {e.preventDefault;}"
            >
                <div class="row mb-4">
                    <div class="col-6">
                        <TextInput
                            label="Nome"
                            v-model="name"
                        />
                    </div>
                    <div class="col-6">
                        <TextInput
                            label="CPF"
                            v-model="cpf"
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <TextInput
                            label="Telefone"
                            v-model="phone"
                        />
                    </div>
                    <div class="col-6">
                        <EmailInput
                            v-model="email"
                        />
                    </div>
                </div>
                <div class="text-end mt-2">
                    <a class="change-password-link align-self-end" href="/password/reset">Alterar senha</a>
                </div>
            </EditForm>
        </div>
    </Section>
</template>

<script>
    import Section from '../components/Section.vue';
    import EditForm from '../components/EditForm.vue';
    import TextInput from '../components/TextInput.vue';
    import EmailInput from '../components/EmailInput.vue';

    export default {
        components: {
            Section,
            EditForm,
            TextInput,
            EmailInput
        },
        data() {
            return {
                name: this.user.name,
                cpf: this.user.cpf,
                phone: this.user.phone,
                email: this.user.email,
            }
        }
    }
</script>

<style scoped>
    .img-home {
        width: 7vw;
        height: auto;
    }

    .form-1 {
        width: max(55vw,850px);
    }

    .change-password-link {
        text-decoration: none;
        color: #BFC9DB;
        font-weight: 600;
        transition: .2s;
    }

    .change-password-link:hover {
        color: white;
    }

</style>