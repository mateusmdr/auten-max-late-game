<template>
    <Section title="Notificações" description="Últimos avisos" icon="notifications">
        <ClientNotificationFilters
            @change="(newFilter) => this.filter = newFilter"
        />
        <ClientNotificationCards
            :notifications="filteredNotifications"
        />
    </Section>
</template>

<script>
import { storeToRefs } from 'pinia';
import {useNotificationStore} from '../../stores/client';

export default {
    setup() {
        const notificationStore = useNotificationStore();
        notificationStore.refresh();

        const {notifications} = storeToRefs(notificationStore);
        return {
            notifications
        }
    },
    computed: {
        filteredNotifications() {
            return this.notifications.filter(this.filter);
        }
    },
    data() {
        return (
            {
                filter: () => true,
            }
        );
    }
}
</script>