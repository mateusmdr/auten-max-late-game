<template>
  <div class="thin-table">
        <Table
            :fields="fields"
            :items="payments"
            :colorPicker="(item) => {
                if(item.is_pending) {
                    return '#EB4263';
                }

                switch(item.plan) {
                    case 'Mensal': return '#B376F8';

                    case 'Semestral': return '#F5A847';

                    default: return '#05F28E';
                }
            }"
            :editAction="editPayment"
            :deleteAction="deletePayment"
            removeIcon="delete"
            :isEditable="(item) => item.status === 'manual'"
        />
    </div>
</template>

<script>
import {usePaymentStore} from "../../../../stores/admin";
import {mapActions} from "pinia";

export default {
    emits: ['edit'],
    props: {
        payments: Array
    },
    created() {
        this.fields = [
            {name: 'Usuário', value: 'user_name', width: 3},
            {name: 'Data', value: 'date', width: 2},
            {name: 'Hora', value: 'time', width: 1},
            {name: 'Plano', value: 'plan', width: 2},
            {name: 'Valor', value: 'price', width: 1},
            {name: 'Forma de Pagamento', value: 'payment_method', width: 2},
        ];
    },
    methods: {
        ...mapActions(usePaymentStore, ['refresh']),
        editPayment(payment) {
            this.$emit('edit', payment);
        },
        deletePayment(payment) {
            const res = confirm("Tem certeza que deseja remover este pagamento?");
            if(res) {
                axios.delete(`/api/payment/${payment.id}`)
                    .catch(() => alert("Falha ao remover o pagamento"))
                    .then(this.refresh);
            }
        }
    }
}
</script>
