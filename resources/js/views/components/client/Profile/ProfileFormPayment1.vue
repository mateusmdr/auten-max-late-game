<template>
    <div class="form-container">
        <EditForm
            :showSubmitButton="hasChanged"
            title="Planos"
            submitText="Salvar edições"
            @submit="submit"
        >
            <p class="mb-5">
                Todos os planos liberam o acesso completo à plataforma
            </p>
            <RadioGroup
                :options="paymentPlans"
                v-model="inputs.paymentPlan"
            />
        </EditForm>
    </div>
</template>

<script>
import axios from "axios";
import { storeToRefs } from "pinia";

import {useCurrentUserStore,usePaymentPlanStore} from '../../../../stores/client';

export default {
    emits: ['update'],
    setup() {
        const currentUserStore = useCurrentUserStore();
        const paymentPlanStore = usePaymentPlanStore();
        paymentPlanStore.refresh();

        const {user} = storeToRefs(currentUserStore);

        const {paymentPlans} = storeToRefs(paymentPlanStore);

        return {
            currentUser: user,
            currentUserStore,
            paymentPlans
        }
    },
    data() {
        return {
            inputs: {
                paymentPlan: this.currentUser.plan_period,
            }
        }
    },
    computed: {
        hasChanged() {
            return this.currentUser.plan_period !== this.inputs.paymentPlan;
        }
    },
    methods: {
        submit() {
            const res = confirm("Tem certeza que deseja alterar o plano de pagamento para \n" + this.paymentPlans.find((val) => val.value === this.inputs.paymentPlan).text + " ?");

            if(!res) return;

            axios
                .put('/api/user/' + this.currentUser.id + '/payment_plan', {
                    period: this.inputs.paymentPlan
                })
                .then(() => this.currentUserStore.refresh())
                .then(() => this.$emit('update'))
                .catch(() => alert("Verifique os dados inseridos"));
        }
    }
}
</script>

<style scoped>
    .form-container {
        width: 35vw;
        margin-right: 4rem;
    }

    .form-container p {
        font-weight: 400;
        color: #BFC9DB;
        font-size: 1rem;
    }
</style>
