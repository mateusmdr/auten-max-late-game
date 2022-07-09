<template>
    <Section title="Usuários cadastrados" icon="person">
        <div class="mt-4">
            <div class="mb-3">
                <router-link :to="{name: 'users'}" class="return-button">
                    <Icon name="navigate_before" color="#7F8896"/>
                    <span class="return-button">Voltar</span>
                </router-link>
            </div>
            <div class="mb-4">
                <span class="user-name">{{user?.name}}</span>
            </div>
            <Stepper v-if="user" :steps="steps">
                <template #step-0>
                    <AdminUserData :user="user" @update="refresh"/>
                </template>
                <template #step-1>
                    <AdminUserPayments :user="user"/>
                </template>
                <template #step-2>
                    <AdminUserNotifications :user="user"/>
                </template>
            </Stepper>
            
        </div>
        
    </Section>
</template>

<script>
import { storeToRefs } from 'pinia';

import {useUserStore} from '../../stores/admin';

export default {
    setup(context) {
        const userStore = useUserStore();

        const {user} = storeToRefs(userStore);

        return {
            user,
            userStore
        }
    },
    created() {
        this.userStore.getUser(this.$route.params.id);
        this.steps = ['Dados', 'Pagamentos', 'Notificações']
    },
    methods: {
        refresh() {
            this.userStore.refresh();
            this.userStore.getUser(this.user.id);
        }
    }
}
</script>

<style scoped>
:deep(.return-button) {
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