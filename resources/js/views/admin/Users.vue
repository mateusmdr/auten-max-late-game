<template>
    <Section title="Usuários cadastrados" icon="person">
        <AdminCreateUserModal/>
        
        <AdminUsersFilters/>

        <AdminUsersTable
            :users="users"
        />
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
    data: function() {
        return {
            users: null
        }
    }
}
</script>