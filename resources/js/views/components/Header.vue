<template>
    <header class="row align-items-center">
            <router-link 
                :to="{name: 'home'}"
                class="col-1"
            >
                <img class="img-header-logo" src="@images/header_logo.png"/>
            </router-link>
            <nav class="col-10">
                <ul v-if="isAdmin">
                    <li><LinkIcon icon='emoji_events' url='tournaments'/></li>
                    <li><LinkIcon icon='person' url='users'/></li>
                    <li><LinkIcon icon='notifications' url='notifications'/></li>
                    <li><LinkIcon icon='request_quote' url='payments'/></li>
                    <li><LinkIcon icon='picture_in_picture' url='ads'/></li>
                    <li><LinkIcon icon='settings' url='settings'/></li>
                </ul>

                <ul v-else>
                    <li><LinkIcon icon='notifications' url='notifications'/></li>
                    <li><LinkIcon icon='emoji_events' url='tournaments'/></li>
                    <li><LinkIcon icon='person' url='profile'/></li>
                </ul>
            </nav>
            <div class="col-1">
                <a @click="this.logout"><LinkIcon icon='logout' url='/' :isRoute="false"/></a>
            </div>
    </header>
</template>

<script>
import LinkIcon from './LinkIcon.vue';

import axios from 'axios';

export default {
    components: {LinkIcon},
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