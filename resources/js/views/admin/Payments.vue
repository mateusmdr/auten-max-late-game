<template>
  <Section title="Últimos Pagamentos" icon="request_quote">
        
        <AdminPaymentsFilters/>

        <AdminPaymentsTable
            :payments="payments"
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
        }
    }
}
</script>

<style>

</style>