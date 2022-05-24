<template>
    <div class="container d-flex justify-content-center mb-3">
        <img src="@images/poker_chips_4.png" class="img-home unselectable">
    </div>

    <Section title="Notificações" description="Últimos avisos" icon="notifications">
        <ClientNotificationCards
            :notifications="notifications.slice(0,4)"
        />
    </Section>

    <ClientScheduledTournamentsTable/>
    
</template>

<script>
import { storeToRefs } from 'pinia';
import {useNotificationStore} from '../../stores/client';

export default {
    setup() {
        const notificationStore = useNotificationStore();

        const {notifications} = storeToRefs(notificationStore);
        return {
            notifications
        }
    },
}
</script>

<style scoped>
    .custom-card-body {
        min-height: 5.25rem;
    }
</style>