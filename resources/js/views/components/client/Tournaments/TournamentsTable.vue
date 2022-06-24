<template>
    <Table
        defaultActionIcon='alarm_add'
        defaultActionText='Ativar'
        :fields="fields"
        :items="tournaments"
        :colorPicker="(item) => {
            if(item.isNotifiable) {
                return '#B376F8';
            }
            if(item.isRecurrent) {
                return '#F5A847';
            }
            
            return '#05F28E';
        }"
        :disableAction="item => item.isNotifiable"
        :action="(item) => selectTournament(item)"
    />
</template>

<script>
export default {
    emits: ['select'],
    created() {
        this.fields = [
            {name: '', value: 'name', width: 2},
            {name: 'Dia', value: 'date', width: 1},
            {name: 'Inscrição', value: 'subscription', width: 2},
            {name: 'Plataforma', value: 'platform_name', width: 2},
            {name: 'Tipo torneio', value: 'type_name', width: 2},
            {name: 'Buy-in', value: 'buy_in', width: 1},
            {name: 'Prêmio', value: 'prize', width: 1}
        ];
    },
    methods: {
        selectTournament(tournament) {
            this.$emit('select',tournament);
        }
    },
    props: {
        tournaments: Array
    }
}
</script>

<style>

</style>