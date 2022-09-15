<template>
    <img src="@images/banners.png" alt="Referência de posição dos banners"/>
    <AdminCreateBannerModal v-if="banners.length<5 && !selectedBanner"/>
    <AdminEditBannerModal
        v-if="selectedBanner"
        @close="selectedBanner = null"
        :banner="selectedBanner"
    />
    <AdminBannersTable :banners="banners" @edit="selectedBanner = $event"/>
</template>

<script>
import {useBannerStore} from "../../../../stores/admin";
import {mapState} from "pinia";
import BannersTable from "./BannersTable";

export default {
    components: {BannersTable},
    computed: {
        ...mapState(useBannerStore, ['banners'])
    },
    data() {
        return {
            selectedBanner: null
        }
    },
}
</script>
