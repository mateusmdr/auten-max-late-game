<template>
    <router-link 
        :to="{name: this.url}"
        v-if="this.isRoute"
    >
        <icon :name="icon"></icon>
    </router-link>
    
    <a :href="this.url" v-else>
        <icon :name="icon"></icon>
    </a>
</template>

<script>
import Icon from "./Icon.vue"

export default {
    components: { Icon },
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