<template>
    <Section title="Usuários cadastrados" icon="person">
        <div class="mt-4">
            <div class="mb-3">
                <router-link :to="{name: 'users'}" class="return-button">
                    <Icon name="navigate_before" color="#7F8896"/>
                    <span class="return-button">Voltar</span>
                </router-link>
            </div>
            <div>
                <span class="user-name">{{user.name}}</span>
            </div>
        </div>
        
    </Section>
</template>

<script>
import { storeToRefs } from 'pinia';
import {useUserStore} from '../../stores/admin';

export default {
    setup() {
        const userStore = useUserStore();
        userStore.refresh();

        const {users} = storeToRefs(userStore);
        return {
            users
        }
    },
    computed: {
        user() {
            return this.users.find(item => item.id == this.$route.params.id);
        }
    }
}
</script>

<style scoped>
::v-deep .return-button {
    color: #7F8896;
    text-decoration: none;
    font-weight: 600;
}

.user-name {
    color: #05F28E;
    font-weight: 700;
    font-size: 1.125rem;
}
</style>