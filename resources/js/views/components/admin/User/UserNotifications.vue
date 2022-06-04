<template>
    <div>
        <AdminUserNotificationFilters
            @change="(newFilter) => this.filter = newFilter"
        />
        <AdminUserNotificationCards
            :notifications="filteredNotifications"
        />
    </div>
</template>

<script>
import { storeToRefs } from 'pinia';
import {useNotificationStore} from '../../../../stores/admin';

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
            return this.notifications.filter(this.filter).filter(notification => notification.user_id == this.user?.id);
        }
    },
    data() {
        return (
            {
                filter: notification => notification.user_id == this.user?.id
            }
        );
    },
    props: {
        user: Object
    }
}
</script>