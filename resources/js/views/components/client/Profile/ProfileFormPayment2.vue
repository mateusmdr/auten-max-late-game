<template>
    <div class="form-container">
        <EditForm
            :showSubmitButton="true"
            title="Pagamento"
            submitText="Salvar edições"
            @submit="submit"
        >   
            <div class="d-flex flex-row gap-4 mb-3">
                <RadioGroup
                    :options="paymentMethods"
                    v-model="inputs.paymentMethod"
                />
            </div>

            <div class="ticket-form" v-if="inputs.paymentMethod === 0">
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
                            v-model="inputs.cardNumber"
                        />
                    </div>
                    <div class="col-6">
                        <TextInput
                            label="Nome do titular"
                            v-model="inputs.cardholderName"
                        />
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6">
                        <TextInput
                            label="CPF"
                            v-model="inputs.cpf"
                        />
                    </div>
                    <div class="col-3">
                        <DateInput
                            label="Validade"
                            monthPicker
                            v-model="inputs.expireDate"
                        />
                    </div>
                    <div class="col-3">
                        <TextInput
                            name="CVV"
                            v-model="inputs.cvv"
                        />
                    </div>
                </div>
            </div>
        </EditForm>
    </div>
</template>

<script>
export default {
    created() {
        this.paymentMethods = [
            {
                value: 'bolbradesco',
                text: 'Boleto',
            },
            {
                value: 'credit_card',
                text: 'Cartão de crédito',
            }
        ];
    },
    data() {
        return {
            hasPendingTicket: true,
            inputs: {
                paymentMethod: 0,
                cardNumber: null,
                cardholderName: null,
                cpf: null,
                expireDate: null,
                cvv: null,
            }
        }
    },
    methods: {
        submit() {
            this.mercadoPago
                .createCardToken({
                    cardNumber: this.inputs.cardNumber,
                    cardholderName: this.inputs.cardholderName,
                    identificationType: 'CPF',
                    identificationNumber: this.inputs.cpf,
                    securityCode: this.inputs.cvv,
                    cardExpirationMonth: (this.inputs.expireDate.month + 1).toString(),
                    cardExpirationYear: this.inputs.expireDate.year.toString(),
                })
                .then(({id}) => {
                    console.log({token: id});
                    axios.post('/api/payment', {
                        'card_token': id
                    })
                    .then(console.log);
                })
                .catch(code => alert(code));
        }
    }
}
</script>

<style scoped>
    .form-container {
        width: calc(8/12 * 100%);
    }
</style>