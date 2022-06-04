<template>
  <div>
        <AdminUserPaymentsFilters
            @change="(newFilter) => this.filter = newFilter"
        />

        <AdminPaymentsTable
            :payments="filteredPayments"
        />
  </div>
</template>

<script>
import { storeToRefs } from 'pinia';
import {usePaymentStore} from '../../../../stores/admin';

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
            filter: payment => payment.user_id == this.user?.id
        }
    },
    computed: {
        filteredPayments() {
            return this.payments.filter(payment => payment.user_id == this.user?.id).filter(this.filter);
        }
    },
    props: {
        user: Object
    }
}
</script>

<style>

</style>