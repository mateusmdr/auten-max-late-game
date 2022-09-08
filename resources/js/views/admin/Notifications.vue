<template>
    <Section title="Últimas notificações" icon="notifications">
        <AdminCreateNotificationModal/>

        <AdminNotificationsFilters
            @change="(newFilter) => this.filter = newFilter"
        />

        <AdminNotificationsTable
            :notifications="filteredNotifications"
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
    data() {
        return {
            filter: () => true,
        }
    },
    computed: {
        filteredNotifications() {
            return this.notifications.filter(this.filter);
        }
    },
}
</script>
