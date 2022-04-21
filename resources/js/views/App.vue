<template>
    <div>
        <Header :is-admin="user.is_admin"/>
        <main class="mt-5">
            <router-view/>
        </main>
        <Ad v-if="!user.is_admin"/>
        <Footer v-if="!user.is_admin"/>
    </div>
</template>

<script>
    import Header from './components/Header.vue';
    import Footer from './components/Footer.vue';
    import Ad from './components/client/Ad.vue';

    export default {
        components: {Header, Footer, Ad}
    }
</script>

<style>
    .img-home {
        width: 7vw;
        height: auto;
        min-width: 180px;
    }
</style>