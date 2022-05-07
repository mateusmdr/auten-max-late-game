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
import { storeToRefs } from 'pinia';
import {useAdsStore} from '../../stores/admin';

export default {
    setup() {
        const adsStore = useAdsStore();
        adsStore.refresh();

        const {ads} = storeToRefs(adsStore);
        return {
            ads
        }
    },
    computed: {
        filteredAds() {
            return this.ads.filter(this.filter);
        }
    },
    data() {
        return {
            filter: () => true,
        }
    }
}
</script>