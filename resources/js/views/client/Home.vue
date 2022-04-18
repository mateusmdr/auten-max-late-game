<script setup>
    import Page from './Page.vue';
    import DynamicButton from '../components/DynamicButton.vue';
    import StaticButton from '../components/StaticButton.vue';
</script>

<template>
    <Page>
        <div>sou client</div>
        <DynamicButton text="Dinâmico"/>
        <StaticButton text="Estático 1"/>
        <StaticButton text="Estático 2" :primary="false"/>
    </Page>
</template>