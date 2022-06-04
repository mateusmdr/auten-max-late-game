<template>
    <section class="container-fluid" v-if="ad">
        <a :href="ad.link_url">
            <div class="ad-img" :style="`background-image: url('${ad.img_url}');`"></div>
        </a>
    </section>
</template>

<script>
import {storeToRefs} from 'pinia';

import {useAdStore} from '../../../stores/client';

export default {
    setup() {
        const adStore = useAdStore();
        adStore.refresh();

        const {ad} = storeToRefs(adStore);

        return {
            adStore,
            ad
        }
    },
    watch: {
        ad() {
            console.log(this.ad);
        }
    }
}
</script>

<style scoped>
    section {
        width: calc(100% - 8rem);
        margin: 8rem auto 6rem auto;
    }

    .ad-img {
        width: 100%;
        padding-top: calc(168/1312 * 100%);
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>