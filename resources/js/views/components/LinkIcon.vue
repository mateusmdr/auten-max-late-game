<template>
    <router-link 
        :to="this.url"
        v-if="this.isRoute"
    >
        <i :class="`bi ${this.icon}`"></i>
    </router-link>
    
    <a :href="this.url" v-else>
        <i :class="`bi ${this.icon}`"></i>
    </a>
</template>

<script>
export default {
    props: {
        icon: {
            type: String,
            default: ''
        },
        url: {
            type: String,
            default: ''
        },
        isRoute: {
            Boolean,
            default: true
        }
    }
}
</script>

<style scoped>
    i {
        font-size: 1.5em;
    }

    a, a:visited {
        color: #F2F5FA;
    }

    a:hover {
        color: #BFC9DB;
    }
</style>