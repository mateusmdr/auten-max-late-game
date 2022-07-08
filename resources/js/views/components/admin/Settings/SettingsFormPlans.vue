<template>
    <div class="form-container">
        <EditForm
            :showSubmitButton="hasChanged"
            title="Planos"
            submitText="Salvar edições"
            @submit="updatePlans"
            v-if="!this.isLoading"
        >
            <div class="row mb-3">
                <div class="col-5">
                    <DisabledInput
                        label="Período"
                        value="Mensal"
                    />
                </div>
                <div class="col-7">
                    <TextInput
                        name="Valor"
                        v-model="inputs.monthly"
                    />
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-5">
                    <DisabledInput
                        label="Período"
                        value="Semestral"
                    />
                </div>
                <div class="col-7">
                    <TextInput
                        name="Valor"
                        v-model="inputs.biannual"
                    />
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-5">
                    <DisabledInput
                        label="Período"
                        value="Anual"
                    />
                </div>
                <div class="col-7">
                    <TextInput
                        name="Valor"
                        v-model="inputs.yearly"
                    />
                </div>
            </div>
        </EditForm>
    </div>
</template>

<script>
import { storeToRefs } from 'pinia';
import {usePaymentPlanStore} from '../../../../stores/admin';
import deepEqual from 'deep-equal';

export default {
    setup() {
        const paymentPlanStore = usePaymentPlanStore();
        paymentPlanStore.refresh();

        const {paymentPlans, isLoading} = storeToRefs(paymentPlanStore);
        return {
            paymentPlans,
            isLoading,
            paymentPlanStore
        }
    },
    watch: {
        paymentPlans() {
            this.inputs = {
                monthly: this.paymentPlans.monthly.price,
                biannual: this.paymentPlans.biannual.price,
                yearly: this.paymentPlans.yearly.price,
            }
        },
    },
    computed: {
        hasChanged() {
            let prices = {
                monthly: this.paymentPlans.monthly.price,
                biannual: this.paymentPlans.biannual.price,
                yearly: this.paymentPlans.yearly.price,
            };

            return !deepEqual(this.inputs, prices);
        }
    },
    data() {
        return {
            inputs: {
                monthly: this.paymentPlans.monthly?.price,
                biannual: this.paymentPlans.biannual?.price,
                yearly: this.paymentPlans.yearly?.price
            },
        }
    },
    methods: {
        updatePlans() {
            Promise.all([
                axios.put(`/api/payment_plan/${this.paymentPlans.monthly.id}`,{
                    price: this.inputs.monthly
                }),
                axios.put(`/api/payment_plan/${this.paymentPlans.biannual.id}`,{
                    price: this.inputs.biannual
                }),
                axios.put(`/api/payment_plan/${this.paymentPlans.yearly.id}`,{
                    price: this.inputs.yearly
                }),
            ]).then(() => this.paymentPlanStore.refresh());
        }
    }
}
</script>

<style scoped>
    .form-container {
        width: 35vw;
        min-width: 450px;
    }
</style>