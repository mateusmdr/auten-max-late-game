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
                return '#F5A847';
            }

            return '#05F28E';
        }"
        :action="viewTournament"
        :approveAction="approveTournament"
        :editAction="editTournament"
        :deleteAction="deleteTournament"
        :isEditable="(item) => !item.isApproved"
    />
</template>

<script>
export default {
    emits: ['select', 'editMode', 'viewMode', 'removeMode', 'update'],
    created() {
        this.fields = [
            {name: '', value: 'formattedDate', width: 1},
            {name: 'Nome', value: 'name', width: 3},
            {name: 'Inscrição', value: 'subscription', width: 2},
            {name: 'Plataforma', value: 'platform_name', width: 2},
            {name: 'Tipo torneio', value: 'type_name', width: 2},
            {name: 'Buy-in', value: 'buy_in', width: 1},
        ];
    },
    methods: {
        approveTournament(tournament) {
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
                    .finally(() => this.$emit('update'));
            }
        },
        editTournament(tournament) {
            this.$emit('select',tournament);
            this.$emit('editMode');
        },
        viewTournament(tournament) {
            this.$emit('select',tournament);
            this.$emit('viewMode');
        },
        deleteTournament(tournament) {
            this.$emit('select',tournament);
            this.$emit('removeMode');
        },
    },
    props: {
        tournaments: Array
    }
}
</script>

<style>

</style>
