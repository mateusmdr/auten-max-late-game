<template>
  <Section title="Últimos Pagamentos" icon="request_quote">
        <RadioChips
            :chips="paymentStatuses"
            v-model="inputs.paymentStatus"
        />
        <div class="input-container my-5">
            <div class="row">
                <div class="col-2">
                    
                </div>
                <div class="col-1">
                    <DateInput v-model="input.date"/>
                </div>
                <div class="col-1">
                    <TimeInput v-model="input.time"/>
                </div>
                <div class="col-2">
                    <SearchInput
                        v-model="input.filter"
                    />
                </div>
            </div>
        </div>

        <Table
            defaultActionIcon='alarm_add'
            defaultActionText='Ativar'
            :fields="tournamentFields"
            :items="tournaments"
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
            }
        }
    }
}
</script>

<style>

</style>