<template>
    <div class="mt-5">
        <div class="row gx-5">
            <div class="col-3 card-col mb-5 d-flex" v-for="notification in notifications" :key="notification.id">
                <Card :color="getNotificationColor(notification)" :corner-text="`${notification.date} ${notification.time}`">
                    <h3>{{getNotificationTitle(notification)}}</h3>
                    <h4>{{getNotificationDescription(notification)}}</h4>
                </Card>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        notifications: Array,
    },
    methods: {
        getNotificationColor(notification) {
            console.log({...notification});
            if(notification.type === 'tournament') {
                return '#B376F8';
            }
            
            if(notification.type === 'administrative') {
                return '#F5A847';
            }

            return '#05F28E';
        },
        getNotificationTitle(notification) {
            if(notification.type === 'tournament') {
                return notification.tournament.name;
            }
            
            if(notification.type === 'administrative') {
                return 'Administração';
            }

            return 'Financeiro';
        },
        getNotificationDescription(notification) {
            if(notification.type === 'tournament') {
                return '#B376F8';
            }
            
            return notification.description;
        }
    }
}
</script>

<style scoped>
    .card-col {

    }
    
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