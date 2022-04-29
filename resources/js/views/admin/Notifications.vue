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
    export default {
        data: function() {
            return {
                notifications: Array(8).fill(
                    {
                        id: 3,
                        title: 'Nome do Destinatário',
                        values: [
                            '00/00/0000',
                            '00h00',
                            'descrição da mensagem descrição da mensagem descrição da mensagem descrição',
                        ],
                    }
                )
            }
        }
    }
</script>