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
                    <a class="text-decoration-none" v-if="!ticketLoading" :href="ticket_url" download="boleto.pdf" target="_blank">
                        Fazer download do boleto <Icon name="download"/>
                    </a>
                    <h4 v-else>Gerando fatura...</h4>
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
                                label="CPF/CNPF do titular"
                                v-model="inputs.identificationNumber"
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

        this.generateTicket();
    },
    data() {
        return {
            inputs: {
                paymentMethod: this.currentUser.payment_method,
                cardNumber: null,
                cardholderName: null,
                identificationNumber: null,
                expireDate: null,
                cvv: null,
            },
            ticket_url: null,
            ticketLoading: true,
        };
    },
    methods: {
        submit() {
            const method = this.inputs.paymentMethod;
            const res = confirm("Tem certeza que deseja alterar o plano de pagamento para \n" + this.paymentMethods.find((val) => val.value === method).text + " ?");
            if (!res)
                return;
            axios
                .put("/api/user/" + this.currentUser.id + "/payment_plan", {
                    method: method
                })
                .then(() => this.currentUserStore.refresh())
                .then(() => {
                    this.generateTicket();
                })
                .catch(() => alert("Verifique os dados inseridos"));
        },
        generateTicket() {
            if(this.currentUser.payment_method === 'bolbradesco' && !this.currentUser.isRegular) {
                this.ticketLoading = true;
                const self = this;
                
                axios
                    .post("/api/payment", {
                        "is_ticket": true
                    })
                    .then((res) => {self.ticket_url = res.data.url; return res.data.url})
                    .catch(() => alert("Falha ao gerar o boleto"))
                    .finally(() => {self.ticketLoading = false});
            }
        },
        creditCardTransaction() {
            const cpf_cnpf = this.inputs.identificationNumber.replace(/\D/g,'');
            const cardNumber = this.inputs.cardNumber.replace(/\D/g,'');
            const cardExpirationMonth = ("00" + (this.inputs.expireDate.month + 1).toString()).slice(-2);

            if(!(cardNumber &&  this.inputs.cardholderName && this.inputs.identificationNumber &&
                this.inputs.expireDate && this.inputs.cvv)) {
                alert("Há dados não preenchidos");
                return;
            }

            if(![11,14].includes(cpf_cnpf.length)) {
                alert("Verifique o CPF/CNPJ");
                return;
            }
            
            this.mercadoPago
                .createCardToken({
                    cardNumber: cardNumber,
                    cardholderName: this.inputs.cardholderName,
                    identificationNumber: cpf_cnpf,
                    identificationType: cpf_cnpf.length === 11 ? 'CPF' : 'CNPJ',
                    securityCode: this.inputs.cvv,
                    cardExpirationMonth: cardExpirationMonth,
                    cardExpirationYear: this.inputs.expireDate.year.toString(),
                })
                .then(({ id }) => {
                    axios.post("/api/payment", {
                        "is_ticket": false,
                        "card_token": id,
                        "cardholderName": this.inputs.cardholderName,
                        "identificationNumber": cpf_cnpf
                    })
                    .then(() => {
                        this.currentUserStore.refresh();
                        alert("Pagamento Realizado com sucesso!");
                        this.$router.push({name: 'home'});
                        this.$forceUpdate();
                    })
                    .catch(error => alert(error.response ? error.response.data?.error : error));
                })
                .catch((e) => {alert("Verifique os dados inseridos");console.error(e)});
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