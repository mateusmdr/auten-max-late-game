<template>
    <Table
        defaultActionIcon='alarm_add'
        defaultActionText='Ativar'
        :fields="fields"
        :items="tournaments"
        :colorPicker="(item) => {
            if(item.enabledNotification) {
                return '#EB4263';
            }
            if(item.isRecurrent) {
                return '#F5A847';
            }
            
            return '#05F28E';
        }"
        :defaultAction="(item) => activateNotification(item)"
    />
</template>

<script>
export default {
    created() {
        this.fields = [
            {name: '', value: 'name', width: 2},
            {name: 'Dia', value: 'date', width: 1},
            {name: 'Inscrição', value: 'subscription', width: 2},
            {name: 'Plataforma', value: 'platform_name', width: 2},
            {name: 'Tipo torneio', value: 'type_name', width: 1},
            {name: 'Buy-in Mín', value: 'min', width: 1},
            {name: 'Buy-in Máx', value: 'max', width: 1},
            {name: 'Prêmio', value: 'prize', width: 1}
        ];
    },
    methods: {
        activateNotification(tournament) {
            let res;
            if(tournament.isRecurrent) {
                res = confirm("Tem certeza que deseja aprovar esta ocorrência de torneio?");
            }else {
                res = confirm("Tem certeza que deseja aprovar este torneio?");
            }
            
            if(res) {
                axios
                    .put(`/api/tournament/${tournament.id}`, {
                        'is_approved': true
                    })
                    .catch(res => {alert("Falha ao aprovar o torneio: " + res.response.data?.errors)})
                    .finally(this.tournamentStore.refresh);
            }
        },
    },
    props: {
        tournaments: Array
    }
}
</script>

<style>

</style>