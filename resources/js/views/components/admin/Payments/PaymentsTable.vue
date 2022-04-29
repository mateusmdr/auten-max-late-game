<template>
  <div class="thin-table">
        <Table
            defaultActionIcon='person'
            defaultActionText='Ver perfil'
            :actionWidth="0"
            :fields="fields"
            :items="payments"
            noAction
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
            {name: 'Data', width: 2},
            {name: 'Hora', width: 2},
            {name: 'Plano', width: 2},
            {name: 'Valor', width: 2},
            {name: 'Forma de Pagamento', width: 2},
        ];
    }
}
</script>