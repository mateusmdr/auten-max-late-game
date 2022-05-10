<template>
  <Section title="Últimos Pagamentos" icon="request_quote">
        
        <AdminPaymentsFilters
            @change="(newFilter) => this.filter = newFilter"
        />

        <AdminPaymentsTable
            :payments="filteredPayments"
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
            filter: () => true
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