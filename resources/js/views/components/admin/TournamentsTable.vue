<template>
    <Table
        defaultActionIcon='add'
        defaultActionText='Ver mais'
        :fields="fields"
        :items="tournaments"
    />
</template>

<script>
export default {
    created() {
        this.fields = [
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