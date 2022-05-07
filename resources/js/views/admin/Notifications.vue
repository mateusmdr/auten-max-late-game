<template>
    <Section title="Últimas notificações" icon="notifications">
        <AdminCreateNotificationModal/>

        <AdminNotificationsFilters/>

        <AdminNotificationsTable
            :notifications="notifications"
        />
    </Section>
</template>

<script>
import { storeToRefs } from 'pinia';
import {useNotificationStore} from '../../stores/admin';

export default {
    setup() {
        const notificationStore = useNotificationStore();
        notificationStore.refresh();

        const {notifications} = storeToRefs(notificationStore);
        return {
            notifications
        }
    },
}
</script>