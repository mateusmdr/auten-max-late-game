<script setup>
    import LinkIcon from './LinkIcon.vue';

    import axios from 'axios';
</script>

<template>
    <header class="row align-items-center">
            <a href="/home" class="position-relative col-1">
                <img class="img-header-logo" src="@images/header_logo.png"/>
            </a>
            <nav class="col-10">
                <ul v-if="isAdmin">
                    <li><LinkIcon icon='bi-trophy' url='tournaments'/></li>
                    <li><LinkIcon icon='bi-person' url='profile'/></li>
                    <li><LinkIcon icon='bi-bell' url='notifications'/></li>
                    <li><LinkIcon icon='bi-cash' url='payments'/></li>
                    <li><LinkIcon icon='bi-pip' url='ads'/></li>
                    <li><LinkIcon icon='bi-gear' url='settings'/></li>
                </ul>

                <ul v-else>
                    <li><LinkIcon icon='bi-bell' url='notifications'/></li>
                    <li><LinkIcon icon='bi-trophy' url='tournaments'/></li>
                    <li><LinkIcon icon='bi-person' url='profile'/></li>
                    <li><LinkIcon icon='bi-gear' url='settings'/></li>
                </ul>
            </nav>
            <div class="col-1">
                <a @click="this.logout"><LinkIcon icon='bi-box-arrow-right' url='/'/></a>
            </div>
    </header>
</template>

<script>
export default {
    methods: {
        logout (e) {
            e.preventDefault();
            axios('/logout', {method: 'post'})
                .then(function (response) {
                    location.replace('/login')
                });
        }
    },
    props: {
        isAdmin: {
            type: Boolean,
            default: false
        }
    }
}
</script>

<style scoped>
    header {
        background: linear-gradient(180deg, #000000 0%, #141414 100%);
        height: 64px;
        padding: 0 64px;
    }

    ul {
        list-style: none;
        display: flex;
        flex-direction: row;
        margin-bottom: 0;
        padding-left: 0;
        justify-content: center;
    }

    ul li {
        margin: 0 1rem;
    }
    
    .img-header-logo {
        height: 32px;
        width: auto;
    }

    nav {
        text-align: center;
    }
</style>