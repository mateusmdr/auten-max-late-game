<template>
    <Section title="Anúncios cadastrados" icon="picture_in_picture">
        <AdminCreateAdModal/>

        <AdminAdsFilters/>

        <AdminAdsTable
            :ads="filteredAds"
        />
    </Section>
</template>

<script>
    export default {
        computed: {
            filteredAds() {
                return this.ads.filter(this.filter);
            }
        },
        data() {
            return {
                filter: () => true,
                ads: Array(4).fill(
                    {
                        id: 1,
                        title: 'Título do torneio',
                        color: '#05F28E',
                        values: [
                            'https://upload.wikimedia.org/wikipedia/commons/thumb/7/77/Google_Images_2015_logo.svg/800px-Google_Images_2015_logo.svg.png',
                            '00/00/0000',
                            '00/00/0000',
                            'R$ 00,00',
                        ],
                        isEditable: false,
                        defaultAction: () => console.log("fui clicado")
                    }
                )
            }
        }
    }
</script>

<style scoped>
    .img-home {
        width: 7vw;
        height: auto;
    }
</style>