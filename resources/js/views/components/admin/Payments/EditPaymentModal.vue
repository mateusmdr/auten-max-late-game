<template>
	<Modal
		noButton
        modalTitle= "Editar Pagamento"
        modalIcon= "request_quote"
        submitModalText= "Salvar"
        :width="55"
        @submit="submit"
        ref="modal"
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
    useTournamentTypeStore,
    useTournamentPlatformStore,
    useTournamentStore,
    useUserStore, usePaymentStore
} from '../../../../stores/admin';
import {mapState, mapStores, storeToRefs} from 'pinia';

import moment from 'moment';
import DisabledInput from "../../DisabledInput";
import {format, parse} from "date-format-parse";
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
    props: ['payment'],
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
    mounted() {
        this.$refs.modal.openModal();
    },
    data() {
        return {
            inputs: {
                user: this.payment.user,
                date: parse(this.payment.date, "DD/MM/YYYY"),
                time: this.payment.time,
                price: Number(this.payment.price.slice(3)),
                paymentPlan: this.payment.plan_period,
                paymentMethod: this.payment.payment_method.toLocaleLowerCase().replaceAll(' ','')
            }
        }
    },
    computed: {
        ...mapStores(usePaymentStore)
    },
    methods: {
        submit() {
            axios
                .put(`/api/payment/${this.payment.id}`, {
                    datetime: format(this.inputs.date, "YYYY-MM-DD") + " " + this.inputs.time,
                    price: this.inputs.price,
                    payment_plan: this.inputs.paymentPlan,
                    payment_method: this.inputs.paymentMethod,
                    user_id: this.inputs.user.id
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
                .finally(this.paymentStore.refresh);
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

<style>

.v-custom *{
    cursor: pointer;
}

.v-custom .vs__search::placeholder,
.v-custom .vs__dropdown-toggle,
.v-custom .vs__dropdown-menu{
    background: #4F4F4F;
    border: none;
    color: #BFC9DB;
}

.v-custom .vs__selected {
    color: #BFC9DB;
}

.v-custom .vs__clear,
.v-custom .vs__open-indicator {
    fill: #BFC9DB;
}

.v-custom .vs__dropdown-toggle {
    height: 3rem;
    padding: 0 1rem;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
}

</style>
