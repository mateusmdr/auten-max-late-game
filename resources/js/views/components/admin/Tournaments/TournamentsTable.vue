<template>
    <Table
        defaultActionIcon='add'
        defaultActionText='Ver mais'
        :fields="fields"
        :items="tournaments"
        :colorPicker="(item) => {
            if(!item.isApproved) {
                return '#EB4263';
            }
            if(item.isRecurrent) {
                return '#05F28E';
            }
            
            return '#F5A847';
        }"
        :action="(item) => true"
        :isEditable="(item) => !item.isApproved"
    />
</template>

<script>
export default {
    created() {
        this.fields = [
            {name: '', value: 'name', width: 2},
            {name: 'Dia', value: 'date', width: 1},
            {name: 'Inscrição', value: 'subscription', width: 2},
            {name: 'Plataforma', value: 'platform', width: 2},
            {name: 'Tipo torneio', value: 'type', width: 1},
            {name: 'Buy-in Mín', value: 'min', width: 1},
            {name: 'Buy-in Máx', value: 'max', width: 1},
            {name: 'Prêmio', value: 'prize', width: 1}
        ];
    },
    props: {
        tournaments: Array
    }
}
</script>

<style>

</style>