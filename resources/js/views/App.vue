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
    import Footer from './components/client/Footer.vue';
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

    .absolute-top-right {
        position: absolute;
        top: 0;
        right: 0;
    }

    .input-icon {
        position: absolute;
        top: 50%;
        right: 1rem;

        transform: translateY(-50%);
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        color: #BFC9DB;
        pointer-events: none;
    }

    input:autofill + .input-icon {
        color: #4F4F4F
    } 

</style>