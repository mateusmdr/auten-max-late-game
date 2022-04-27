<template>
    <router-link 
        :to="{name: this.url}"
        v-if="this.isRoute"
    >
        <Icon :name="icon"></Icon>
    </router-link>
    
    <a :href="this.url" v-else>
        <Icon :name="icon"></Icon>
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
    a, a:visited {
        color: #F2F5FA;
    }

    a:hover {
        color: #BFC9DB;
    }
</style>