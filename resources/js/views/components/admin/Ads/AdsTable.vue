<template>
    <div class="thin-table">
        <Table
            :editAction="editAd"
            :deleteAction="deleteAd"
            removeIcon="delete"
            :isEditable="() => true"
            :fields="fields"
            :items="ads"
            :colorPicker="() => '#B376F8'"
        />
    </div>
</template>

<script>
import {mapActions} from "pinia";
import {useAdStore} from "../../../../stores/admin";

export default {
    created() {
        this.fields = [
            {name: 'Cliente', value: 'company_name', width: 2},
            {name: 'Imagem', value: 'img_url', width: 4, hasImage: true},
            {name: 'Data início', value: 'begin_at',width: 2},
            {name: 'Data fim', value: 'end_at',width: 2},
            {name: 'Valor', value: 'price',width: 1},
        ];
    },
    props: {
        ads: Array
    },
    emits: ['select'],
    methods: {
        ...mapActions(useAdStore, ['refresh']),
        editAd(ad) {
            this.$emit('select', ad);
        },
        deleteAd(ad) {
            const res = confirm("Tem certeza que deseja remover este anúncio?");
            if(res) {
                axios.delete(`/api/ad/${ad.id}`)
                    .catch(() => alert("Falha ao remover o anúncio"))
                    .then(this.refresh);
            }
        }
    }
}
</script>

<style>

</style>
