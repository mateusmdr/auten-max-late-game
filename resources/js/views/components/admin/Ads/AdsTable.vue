<template>
    <div class="thin-table">
        <Table
            defaultActionIcon='edit'
            :fields="fields"
            :items="ads"
            :colorPicker="() => '#B376F8'"
        />
    </div>
</template>

<script>
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
    }
}
</script>

<style>

</style>