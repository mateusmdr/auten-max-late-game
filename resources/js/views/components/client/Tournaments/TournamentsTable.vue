<template>
    <Table
        :actionIcon="(item) => item.isNotifiable ? 'alarm_off' : 'alarm_add'"
        :actionText="(item) => item.isNotifiable ? 'Desativar' : 'Ativar'"
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
        :action="(item) => item.isNotifiable ? disableTournament(item) : selectTournament(item)"
    />
</template>

<script>
export default {
    emits: ['select'],
    created() {
        this.fields = [
            {name: '', value: 'formattedDate', width: 1},
            {name: 'Nome', value: 'name', width: 2},
            {name: 'Inscrição', value: 'subscription', width: 2},
            {name: 'Tipo torneio', value: 'type_name', width: 2},
            {name: 'Plataforma', value: 'platform_name', width: 1},
            {name: 'Buy-in', value: 'buy_in', width: 1},
            {name: 'Notificação às', value: 'notifications', width: 2}
        ];
    },
    methods: {
        selectTournament(tournament) {
            this.$emit('select',tournament);
        },
        disableTournament(tournament) {
            this.$emit('disable');
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
