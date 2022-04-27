<template>
    <Section title="Perfil" icon="person">
        <nav class="d-flex flex-row mb-5">
            <FormStep
                text="Dados pessoais"
                v-model="formPage"
                :pageNumber="1"
            />

            <FormStep
                text="Plano e Pagamento"
                v-model="formPage"
                :pageNumber="2"
            />
        </nav>

        <div class="form-1" v-if="formPage === 1">
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
                            v-model="inputs.form1.name"
                        />
                    </div>
                    <div class="col-6">
                        <TextInput
                            label="CPF"
                            v-model="inputs.form1.cpf"
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <TextInput
                            label="Telefone"
                            v-model="inputs.form1.phone"
                        />
                    </div>
                    <div class="col-6">
                        <EmailInput
                            v-model="inputs.form1.email"
                        />
                    </div>
                </div>
                <div class="text-end mt-2">
                    <a class="change-password-link align-self-end" href="/password/reset">Alterar senha</a>
                </div>
            </EditForm>
        </div>

        <div class="form-2 d-flex flex-row justify-content-stretch" v-if="formPage === 2">
            <div class="plan-form">
                <EditForm
                    :showSubmitButton="true"
                    title="Planos"
                    submitText="Salvar edições"
                    :submitHandler="(e) => {e.preventDefault;}"
                >
                    <p class="mb-5">
                        Todos os planos liberam o acesso completo à plataforma
                    </p>
                    <RadioGroup
                        :options="paymentPlans"
                        v-model="inputs.form2.paymentPlan"
                    />
                </EditForm>
            </div>
            <div class="payment-form">
                <EditForm
                    :showSubmitButton="true"
                    title="Pagamento"
                    submitText="Salvar edições"
                    :submitHandler="(e) => {e.preventDefault;}"
                >   
                    <div class="d-flex flex-row gap-4 mb-3">
                        <RadioGroup
                            :options="paymentMethods"
                            v-model="inputs.form3.paymentMethod"
                        />
                    </div>

                    <div class="ticket-form" v-if="inputs.form3.paymentMethod === 0">
                        <a class="text-decoration-none" href="/ticket" download v-if="hasPendingTicket">
                            Fazer download do boleto <Icon name="download"/>
                        </a>

                        <p v-else>Nenhuma fatura pendente encontrada.</p>
                    </div>

                    <div class="credit-card-form" v-else>
                        <div class="row mb-4">
                            <div class="col-6">
                                <TextInput
                                    label="Número do cartão"
                                    v-model="inputs.form3.cardNumber"
                                />
                            </div>
                            <div class="col-6">
                                <TextInput
                                    label="Nome do titular"
                                    v-model="inputs.form3.ownerName"
                                />
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <TextInput
                                    label="CPF"
                                    v-model="inputs.form3.cpf"
                                />
                            </div>
                            <div class="col-3">
                                <DateInput
                                    label="Validade"
                                    monthPicker
                                    v-model="inputs.form3.expireDate"
                                />
                            </div>
                            <div class="col-3">
                                <NumberInput
                                    name="CVV"
                                    v-model="inputs.form3.cvv"
                                />
                            </div>
                        </div>
                    </div>
                    
                </EditForm>
            </div>
        </div>
    </Section>
</template>

<script>
    export default {
        data() {
            return {
                formPage: 2,
                hasPendingTicket: true,
                inputs: {
                    form1: {
                        name: this.user.name,
                        cpf: this.user.cpf,
                        phone: this.user.phone,
                        email: this.user.email,
                    },
                    form2: {
                        paymentPlan: 0
                    },
                    form3: {
                        paymentMethod: 0
                    }
                },
                paymentPlans: [
                    {
                        value: 'yearly',
                        text: 'Anual - R$ 199,00',
                    },
                    {
                        value: 'biannual',
                        text: 'Semestral - R$ 119,99',
                    },
                    {
                        value: 'monthly',
                        text: 'Mensal - R$ 29,99',
                    }
                ],
                paymentMethods: [
                    {
                        value: 'bolbradesco',
                        text: 'Boleto',
                    },
                    {
                        value: 'credit_card',
                        text: 'Cartão de crédito',
                    }
                ]
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
        width: max(50vw,850px);
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

    .plan-form {
        width: calc(4/12 * 100% - 4rem);
        margin-right: 4rem;
    }

    .plan-form p {
        font-weight: 400;
        color: #BFC9DB;
        font-size: 1rem;
    }

    .payment-form {
        width: calc(8/12 * 100%);
    }

</style>