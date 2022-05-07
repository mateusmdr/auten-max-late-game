<template>
  <div class="thin-table">
        <Table
            :actionWidth="0"
            :fields="fields"
            :items="payments"
            noAction
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
        />
    </div>
</template>

<script>
export default {
    props: {
        payments: Array
    },
    created() {
        this.fields = [
            {name: 'Usuário', value: 'user_name', width: 3},               
            {name: 'Data', value: 'date', width: 2},
            {name: 'Hora', value: 'time', width: 1},
            {name: 'Plano', value: 'plan', width: 2},
            {name: 'Valor', value: 'price', width: 2},
            {name: 'Forma de Pagamento', value: 'payment_method', width: 2},
        ];
    }
}
</script>