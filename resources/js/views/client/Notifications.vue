<template>
    <Section title="Notificações" description="Últimos avisos" icon="notifications">
        <div class="instructions mb-5">
            <h4>Não perca as notificações</h4>
            <h5>Permita e gerencie as notificações pelo seu computador.</h5>
            <router-link :to="{name: 'instructions'}" class="instructions-link">
                <span class="me-1">Ver detalhes</span>
                <Icon name="arrow_forward_ios" color="#BFC9DB" size="1rem"/>
            </router-link>
        </div>

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

<style scoped lang="scss">
    .instructions {
        background-color: #232323;
        border-radius: 8px;
        padding: 24px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        flex-direction: column;
        h4 {
            font-weight: 700;
            font-size: 16px;
            color: #BFC9DB;
        }
        h5 {
            font-weight: 600;
            font-size: 16px;
            color: #7F8896;
        }
        .instructions-link {
            font-weight: 600;
            font-size: 16px;
            color: #BFC9DB;
            text-decoration: none;
        }
    }
</style>
