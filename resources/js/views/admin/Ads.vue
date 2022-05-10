<template>
    <Section title="Anúncios cadastrados" icon="picture_in_picture">
        <AdminCreateAdModal
            v-if="!selectedAd"
        />
        <AdminEditAdModal
            v-else
            :ad="selectedAd"
            @close="selectedAd = null"
        />

        <AdminAdsFilters
            @change="(newFilter) => this.filter = newFilter"
        />

        <AdminAdsTable
            :ads="filteredAds"
            @select="editAd"
        />
    </Section>
</template>

<script>
import { storeToRefs } from 'pinia';
import {useAdStore} from '../../stores/admin';

export default {
    setup() {
        const adStore = useAdStore();
        adStore.refresh();

        const {ads} = storeToRefs(adStore);
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
            selectedAd: null,
        }
    },
    methods: {
        editAd(ad) {
            this.selectedAd = ad;
        }
    }
}
</script>