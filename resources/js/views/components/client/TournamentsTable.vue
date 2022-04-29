<template>
    <Table
        defaultActionIcon='alarm_add'
        defaultActionText='Ativar'
        :fields="tournamentFields"
        :items="tournaments"
    />
</template>

<script>
export default {
    created() {
        this.tournamentFields = [
            {name: 'Dia', width: 1},
            {name: 'Inscrição', width: 2},
            {name: 'Plataforma', width: 2},
            {name: 'Tipo torneio', width: 1},
            {name: 'Buy-in Mín', width: 1},
            {name: 'Buy-in Máx', width: 1},
            {name: 'Prêmio', width: 1}
        ];
    },
    props: {
        tournaments: Array
    }
}
</script>

<style>

</style>