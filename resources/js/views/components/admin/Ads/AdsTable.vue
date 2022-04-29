<template>
    <div class="thin-table">
        <Table
            defaultActionIcon='edit'
            :fields="fields"
            :items="adRows"
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
    computed: {
        adRows() {
            return this.ads.map(ad => {
                return(
                    {
                        ...ad,
                        color: '#B376F8',
                        action: () => console.log(ad)
                    }
                );
            })
        }
    },
    props: {
        ads: Array
    }
}
</script>

<style>

</style>