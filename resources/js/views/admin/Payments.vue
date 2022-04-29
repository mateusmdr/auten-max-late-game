<template>
  <Section title="Últimos Pagamentos" icon="request_quote">
        
        <AdminPaymentsFilters/>

        <AdminPaymentsTable
            :payments="payments"
        />
  </Section>
</template>

<script>
export default {
    data() {
        return {
            payments: Array(8).fill(
                {
                id: 3,
                title: 'Nome do Usuário',
                values: [
                    '00/00/0000',
                    '00h00',
                    'Mensal',
                    'R$0000,00',
                    'Cartão de crédito'
                ],
                color: '#F5A847'
            }
            )
        }
    }
}
</script>

<style>

</style>