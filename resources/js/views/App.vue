<template>
    <div>
        <Header :is-admin="false"/>
        <main class="mt-5">
            <router-view/>
        </main>
        <Ad/>
        <Footer/>
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