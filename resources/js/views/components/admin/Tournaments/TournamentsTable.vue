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
import {useTournamentStore} from '../../../../stores/admin';

export default {
    emits: ['select', 'editMode', 'viewMode'],
    setup() {
        const tournamentStore = useTournamentStore();

        return {
            tournamentStore
        }
    },
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
                    .finally(this.tournamentStore.refresh);
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
            let res;
            if(tournament.isRecurrent) {
                res = confirm("Tem certeza que deseja cancelar esta ocorrência de torneio?");
            }else {
                res = confirm("Tem certeza que deseja cancelar este torneio?");
            }

            if(res) {
                axios
                    .delete(`/api/tournament/${tournament.id}`)
                    .catch(res => {alert("Falha ao cancelar o torneio: " + res.response.data?.errors)})
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