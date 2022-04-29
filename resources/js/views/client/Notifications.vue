<template>
    <Section title="Notificações" description="Últimos avisos" icon="notifications">
        <RadioChips
            :chips="notificationTypes"
            v-model="notificationTypeIndex"
        />

        <div class="mt-5"></div>
        <div class="row notification-row gx-5 mb-5" v-for="notificationRow, index in chunkArray(notifications, 4)" :key="index">
            <div class="col-3 card-col" v-for="notification in notificationRow" :key="notification.id">
                <Card :color="getNotificationColor(notification)" :corner-text="notification.dateTime">
                    <h3>{{notification.title}}</h3>
                    <h4>{{notification.description}}</h4>
                </Card>
            </div>
        </div>
    </Section>
</template>

<script>
    export default {
        methods: {
            getNotificationColor(notification) {
                const notificationType = this.notificationTypes.find(item => item.id === notification.typeId);

                return notificationType?.color;
            },
            chunkArray(array, chunk_size){
                let chunks = [];
                let chunk;
                
                for (let index = 0; index < array.length; index += chunk_size) {
                    chunk = array.slice(index, index+chunk_size);

                    chunks.push(chunk);
                }

                return chunks;
            }
        },
        data() {
            return {
                notificationTypes: [
                    {
                        text:'Todos',
                        hasIcon: false,
                    },
                    {
                        id: 0,
                        text:'Torneios',
                        color:'#B376F8',
                    },
                    {
                        id: 1,
                        text:'Admnistração',
                        color:'#F5A847',
                    },
                    {
                        id: 2,
                        text:'Financeiro',
                        color:'#05F28E',
                    }
                ],
                notificationTypeIndex: 0,
                notifications: Array(4).fill(
                    {
                        id: 0,
                        typeId: 1,
                        title: 'Admnistração',
                        description: 'A plataforma passará por atualizações amanhã, 12/03/2022, às 17h.',
                        dateTime: '00/00/0000 00h00'
                    }
                ).concat(Array(4).fill(
                    {
                        id: 3,
                        typeId: 2,
                        title: 'Financeiro',
                        description: 'Pagamento Recebido',
                        dateTime: '00/00/0000 00h00'
                    }
                ))
            }
        }
    }
</script>

<style scoped>
    .card-col h3{
        color: #BFC9DB;
        font-weight: 700;
        font-size: 1rem;
    }

    .card-col h4 {
        font-weight: 600;
        font-size: .875rem;
        color: #7F8896;
    }
</style>