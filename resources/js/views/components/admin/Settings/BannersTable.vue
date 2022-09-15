<template>
  <div class="thin-table mt-5">
        <Table
            :fields="fields"
            :items="banners"
            :colorPicker="() => '#B376F8'"
            :editAction="editBanner"
            :deleteAction="deleteBanner"
            removeIcon="delete"
            :isEditable="() => true"
        />
    </div>
</template>

<script>
import {useBannerStore} from "../../../../stores/admin";
import {mapActions} from "pinia";

export default {
    emits: ['edit'],
    props: {
        banners: Array
    },
    created() {
        this.fields = [
            {name: 'Posição', value: 'position', width: 1},
            {name: 'Título', value: 'title', width: 3},
            {name: 'Imagem', value: 'img_url', width: 7, hasImage: true},
        ];
    },
    methods: {
        ...mapActions(useBannerStore, ['refresh']),
        editBanner(banner) {
            this.$emit('edit', banner);
        },
        deleteBanner(banner) {
            const res = confirm("Tem certeza que deseja remover este banner?");
            if(res) {
                axios.delete(`/api/banner/${banner.id}`)
                    .catch(() => alert("Falha ao remover o banner"))
                    .then(this.refresh);
            }
        }
    }
}
</script>

<style scoped>
.thin-table {
    width: 60vw;
}
</style>
