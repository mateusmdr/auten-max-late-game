<template>
    <div class="form-container">
        <EditForm
            :showSubmitButton="hasChanged"
            title="Pagamento"
            submitText="Alterar método de pagamento"
            @submit="submit"
        >   
            <div class="d-flex flex-row gap-4 mb-3">
                <RadioGroup
                    :options="paymentMethods"
                    v-model="inputs.paymentMethod"
                />
            </div>

            <div v-if="!currentUser.isRegular">
                <div class="ticket-form" v-if="currentUser.payment_method === paymentMethods[0].value && !hasChanged">
                    <a class="text-decoration-none" v-if="!currentUser.isRegular" @click="openTicket">
                        Fazer download do boleto <Icon name="download"/>
                    </a>
                </div>

                <div class="credit-card-form" v-else-if="currentUser.payment_method === paymentMethods[1].value && !hasChanged">
                    <div class="row mb-4">
                        <p class="col-12 mb-4">
                            Por motivos de segurança, nossa plataforma não armazena nenhum dos dados digitados abaixo.
                        </p>
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
                                label="CPF do titular"
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
                    <div class="d-flex align-items-center justify-content-center mt-5">
                        <DynamicButton @click="creditCardTransaction" text="Realizar pagamento" type="button"/>
                    </div>
                </div>
            </div>
            <p v-else>Nenhuma fatura pendente encontrada.</p>
        </EditForm>
    </div>
</template>

<script>
import { storeToRefs } from "pinia";

import {useCurrentUserStore} from '../../../../stores/client';

export default {
    setup() {
        const currentUserStore = useCurrentUserStore();
        const { user } = storeToRefs(currentUserStore);
        return {
            currentUser: user,
            currentUserStore
        };
    },
    created() {
        this.paymentMethods = [
            {
                value: "bolbradesco",
                text: "Boleto",
            },
            {
                value: "credit_card",
                text: "Cartão de crédito",
            }
        ];
    },
    data() {
        return {
            inputs: {
                paymentMethod: this.currentUser.payment_method,
                cardNumber: null,
                cardholderName: null,
                cpf: null,
                expireDate: null,
                cvv: null,
            }
        };
    },
    methods: {
        submit() {
            const res = confirm("Tem certeza que deseja alterar o plano de pagamento para \n" + this.paymentMethods.find((val) => val.value === this.inputs.paymentMethod).text + " ?");
            if (!res)
                return;
            axios
                .put("/api/user/" + this.currentUser.id + "/payment_plan", {
                method: this.inputs.paymentMethod
            })
                .then(() => this.currentUserStore.refresh())
                .catch(() => alert("Verifique os dados inseridos"));
        },
        creditCardTransaction() {

            if(!(this.inputs.cardNumber &&  this.inputs.cardholderName && this.inputs.cpf &&
                this.inputs.expireDate && this.inputs.cvv)) {
                alert("Há dados não preenchidos");
                return;
            }
            
            this.mercadoPago
                .createCardToken({
                    cardNumber: this.inputs.cardNumber,
                    cardholderName: this.inputs.cardholderName,
                    identificationType: "CPF",
                    identificationNumber: this.inputs.cpf,
                    securityCode: this.inputs.cvv,
                    cardExpirationMonth: (this.inputs.expireDate.month + 1).toString(),
                    cardExpirationYear: this.inputs.expireDate.year.toString(),
                })
                .then(({ id }) => {
                    axios.post("/api/payment", {
                        "is_ticket": false,
                        "card_token": id,
                        "cardholderName": this.inputs.cardholderName,
                        "identificationNumber": this.inputs.cpf
                    })
                    .then(() => {
                        this.currentUserStore.refresh();
                        alert("Pagamento Realizado com sucesso!");
                        this.$router.push({name: 'home'});
                        this.$forceUpdate();
                    })
                    .catch(error => alert(error.response ? error.response.data?.error : error));
                })
                .catch(() => alert("Verifique os dados inseridos"));
        },
        openTicket() {
            axios.post("/api/payment", {
                "is_ticket": true
            })
            .then(console.log);
        }
    },
    computed: {
        hasChanged() {
            return this.currentUser.payment_method !== this.inputs.paymentMethod;
        }
    }
}
</script>

<style scoped>
    .form-container {
        width: calc(8/12 * 100%);
    }
</style>