<template>
    <div class="mt-5">
        <div class="row gx-5">
            <div class="col-3 card-col mb-5 d-flex" v-for="notification in notifications" :key="notification.id">
                <Card :color="getNotificationColor(notification)" :corner-text="notification.datetime">
                    <h3>{{notification.title}}</h3>
                    <h4 v-if="!(notification.type === 'tournament')">{{notification.description}}</h4>
                    <div v-else>
                        <h4><span class='fw-bold'>Inscrição: </span>{{notification.tournament.subscription}}</h4>
                        <h4><span class='fw-bold'>Plataforma: </span>{{notification.tournament.platform_name}}</h4>
                    </div>
                </Card>
            </div>
        </div>
    </div>
</template>

<script>
import {parse, format} from 'date-format-parse';

export default {
    props: {
        notifications: Array,
    },
    methods: {
        getNotificationColor(notification) {
            if(notification.type === 'tournament') {
                return '#B376F8';
            }
            
            if(notification.type === 'administrative') {
                return '#F5A847';
            }

            return '#05F28E';
        },
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