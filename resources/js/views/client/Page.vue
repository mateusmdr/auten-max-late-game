<script setup>
    import Header from '../components/Header.vue';
    import Footer from '../components/Footer.vue';
</script>

<template>
    <div>
        <Header :is-admin="false"/>
        <main>
            <slot/>
        </main>
        <Footer/>
    </div>
</template>