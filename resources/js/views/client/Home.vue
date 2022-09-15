<template>
    <div class="container mb-3">
        <div class="row top-images align-items-center">
            <div class="col-4 text-center">
                <ClientBanner :position="3"/>
            </div>
            <div class="col-4 text-center">
                <img src="@images/poker_chips_4.png" class="w-50 unselectable my-auto">
            </div>
            <div class="col-4 text-center">
                <ClientBanner :position="4"/>
            </div>
        </div>
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
        notificationStore.refresh();

        const {notifications} = storeToRefs(notificationStore);
        return {
            notifications
        }
    },
}
</script>

<style scoped>
    .top-images {
        height: 168px;
    }
</style>
