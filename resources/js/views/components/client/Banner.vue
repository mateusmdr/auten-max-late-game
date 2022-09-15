<template>
    <a :href="banner.link_url" class="h-100" v-if="banner">
        <div class="banner-img unselectable" :style="`background-image: url('${banner.img_url}');`"></div>
    </a>
</template>

<script>
import {mapState} from 'pinia';

import {useBannerStore} from "../../../stores/client";

export default {
    computed: {
        ...mapState(useBannerStore, ['banners']),
        banner() {
            return this.banners.find(b => b.position === this.position);
        }
    },
    props: ['position']
}
</script>

<style scoped>

.banner-img {
    height: 168px;
    padding-top: calc(168/1312 * 100%);
    background-position: center;
    background-repeat: no-repeat;
    background-size: contain;
}
</style>
