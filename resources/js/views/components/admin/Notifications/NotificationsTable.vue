<template>
    <Table
        defaultActionIcon='delete'
        defaultActionText=''
        :actionWidth="1"
        :fields="fields"
        :items="notificationRows"
    />
</template>

<script>
export default {
    props: {
        notifications: Array
    },
    computed: {
        notificationRows() {
            return this.notifications.map(notification => {
                return(
                    {
                        ...notification,
                        color: '#B376F8',
                        action: () => console.log(notification)
                    }
                );
            })
        }
    },
    created() {
        this.fields = [                    
            {name: 'Data', width: 1},
            {name: 'Hora', width: 1},
            {name: 'Descrição', width: 7},
        ];
    }
}
</script>