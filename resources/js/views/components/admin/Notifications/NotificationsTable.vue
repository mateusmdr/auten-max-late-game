<template>
    <Table
        defaultActionIcon='delete'
        defaultActionText=''
        :actionWidth="1"
        :fields="fields"
        :items="notifications"
        :action="removeNotification"
        :colorPicker="(notification) => {
            switch(notification.type){
                case 'tournament': 
                    return '#B376F8'
                case 'administrative':
                    return '#F5A847'
                default:
                    return '#05F28E';
            }
        }"
    />
</template>

<script>
import { useNotificationStore } from '../../../../stores/admin';

export default {
    emits: ['change'],
    setup() {
        const notificationStore = useNotificationStore();

        return {
            notificationStore
        }
    },
    props: {
        notifications: Array
    },
    created() {
        this.fields = [       
            {name: 'Destinatário', value:'user_name', width: 2},             
            {name: 'Data', value:'date', width: 1},
            {name: 'Hora', value:'time', width: 1},
            {name: 'Descrição', value:'description', width: 7},
        ];
    },
    methods: {
        removeNotification(notification) {
            const res = confirm("Tem certeza que deseja excluir esta notificação?");
            if(res) {
                axios
                    .delete(`/api/notification/${notification.id}`)
                    .then(this.notificationStore.refresh)
                    .catch(() => alert("Falha ao excluir a notificação"));
            }
        }
    }
}
</script>