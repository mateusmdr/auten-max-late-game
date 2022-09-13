<template>
    <Section title="Últimos Pagamentos" icon="request_quote">

        <AdminCreatePaymentModal v-if="!selectedPayment"/>
        <AdminEditPaymentModal
            v-else
            :payment="selectedPayment"
            @close="selectedPayment = null"
        />

        <AdminPaymentsFilters
            @change="(newFilter) => this.filter = newFilter"
        />

        <AdminPaymentsTable
            :payments="filteredPayments"
            @edit="selectedPayment = $event"
        />
    </Section>
</template>

<script>
import { storeToRefs } from 'pinia';
import {usePaymentStore} from '../../stores/admin';

export default {
    setup() {
        const paymentStore = usePaymentStore();
        paymentStore.refresh();

        const {payments} = storeToRefs(paymentStore);
        return {
            payments
        }
    },
    data() {
        return {
            filter: () => true,
            selectedPayment: null
        }
    },
    computed: {
        filteredPayments() {
            return this.payments.filter(this.filter);
        }
    },
}
</script>

<style>

</style>
