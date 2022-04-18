<script setup>
    import Header from '../components/Header.vue';
    import Footer from '../components/Footer.vue';
</script>

<template>
    <div>
        <Header :is-admin="true"/>
        <main>
            <slot/>
        </main>
        <Footer/>
    </div>
</template>