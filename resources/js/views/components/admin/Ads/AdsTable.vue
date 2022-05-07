<template>
    <div class="thin-table">
        <Table
            defaultActionIcon='edit'
            :fields="fields"
            :items="ads"
        />
    </div>
</template>

<script>
export default {
    created() {
        this.fields = [
            {name: 'Imagem', width: 4, hasImage: true},
            {name: 'Data início', width: 2},
            {name: 'Data fim', width: 2},
            {name: 'Valor', width: 1},
        ];
    },
    props: {
        ads: Array
    }
}
</script>

<style>

</style>