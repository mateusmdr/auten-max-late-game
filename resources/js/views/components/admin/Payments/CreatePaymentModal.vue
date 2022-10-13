<template>
	<Modal
		openModalText="Cadastrar novo pagamento"
        modalTitle= "Novo Pagamento"
        modalIcon= "request_quote"
        submitModalText= "Cadastrar"
        :width="55"
        @submit="submit"
        ref="modal"
        :isLoading="isLoading"
	>
        <div class="row mb-3">
            <div class="col-6">
                <InputContainer
                    name="Usuário *"
                >
                    <v-select
                        v-model="inputs.user"
                        label="name"
                        :options="users"
                        class="v-custom"
                        :clearable="false"
                    />
                </InputContainer>
            </div>
            <div class="col-3">
                <DateInput
                    label="Data *"
                    v-model="inputs.date"
                    :minDate="false"
                    :maxDate="true"
                />
            </div>
            <div class="col-3">
                <TimeInput
                    label="Hora *"
                    v-model="inputs.time"
                />
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-3">
                <NumberInput
                    name="Valor *"
                    v-model="inputs.price"
                    :integer="false"
                />
            </div>
            <div class="col-3">
                <Select
                    :options="paymentPlans"
                    v-model="inputs.paymentPlan"
                    name="Plano *"
                />
            </div>
            <div class="col-6">
                <Select
                    :options="paymentMethods"
                    v-model="inputs.paymentMethod"
                    name="Forma de pagamento *"
                />
            </div>
        </div>
	</Modal>
</template>

<script>
import {
    useUserStore, usePaymentStore
} from '../../../../stores/admin';
import {mapState, mapStores, storeToRefs} from 'pinia';

import DisabledInput from "../../DisabledInput";
import {format} from "date-format-parse";
import NumberInput from "../../NumberInput";
import InputContainer from "../../InputContainer";

export default {
    components: {InputContainer, NumberInput, DisabledInput},
    setup() {
        const userStore = useUserStore();
        const {users} = storeToRefs(userStore);

        userStore.refresh();
        return {
            users
        }
    },
    created() {
        this.paymentPlans = [
            {
                name: 'Mensal',
                id: 'monthly'
            },
            {
                name: 'Semestral',
                id: 'biannual'
            },
            {
                name: 'Anual',
                id: 'yearly'
            }
        ];

        this.paymentMethods = [
            {
                name: 'Pix',
                id: 'pix'
            },
            {
                name: 'MuchBetter',
                id: 'muchbetter'
            }
        ];
    },
    data() {
        return {
            isLoading: false,
            inputs: {
                user: null,
                date: null,
                time: null,
                price: null,
                paymentPlan: null,
                paymentMethod: null
            }
        }
    },
    computed: {
        ...mapStores(usePaymentStore)
    },
    methods: {
        submit() {
            this.isLoading = true;
            axios
                .post(`/api/payment/user/${this.inputs.user.id}`, {
                    datetime: format(this.inputs.date, "YYYY-MM-DD") + " " + this.inputs.time,
                    price: this.inputs.price,
                    payment_plan: this.inputs.paymentPlan,
                    payment_method: this.inputs.paymentMethod
				})
                .then(this.$refs.modal.closeModal)
				.then(() => {
					this.inputs = {
                        user: null,
                        date: null,
                        time: null,
                        price: null,
                        paymentPlan: null,
                        paymentMethod: null
                    }
				})
                .catch(res => {this.errors = res.response.data.errors; alert("Verifique os dados inseridos.")})
                .finally(() => {
                    this.paymentStore.refresh();
                    this.isLoading = false;
                });
        }
    }
}
</script>

<style scoped>
    h4 {
        font-weight: 400;
        color: #E2E2FF;
    }

    h5 {
        color: #E2E2FF;
    }
</style>
