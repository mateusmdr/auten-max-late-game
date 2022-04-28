<template>
  <Section title="Últimos Pagamentos" icon="request_quote">
        <RadioChips
            :chips="paymentStatuses"
            v-model="inputs.paymentStatus"
        />
        <div class="input-container my-5">
            <div class="row">
                <div class="col-2">
                    <TextInput
                        label="Destinatário"
                        v-model="inputs.username"
                    />
                </div>
                <div class="col-1">
                    <DateInput v-model="inputs.date"/>
                </div>
                <div class="col-1">
                    <TimeInput v-model="inputs.time"/>
                </div>
                <div class="col-2">
                    <SearchInput
                        v-model="inputs.filter"
                    />
                </div>
            </div>
        </div>
        <AdminPaymentsTable
            :payments="payments"
        />
  </Section>
</template>

<script>
export default {
    data() {
        return {
            paymentStatuses: [
                {
                    text:'Todos',
                    hasIcon: false,
                },
                {
                    text:'Mensal',
                    color:'#B376F8',
                },
                {
                    text:'Semanal',
                    color:'#F5A847',
                },
                {
                    text:'Anual',
                    color:'#05F28E',
                },{
                    text: 'Pendentes',
                    color: '#EB4263'
                }
            ],
            inputs: {
                paymentStatus: 0,
                date: null,
                time: null,
                filter: null,
            },
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