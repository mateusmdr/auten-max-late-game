<template>
    <Table
        defaultActionIcon='delete'
        defaultActionText=''
        :actionWidth="1"
        :fields="fields"
        :items="notifications"
        :colorPicker="() => '#B376F8'"
    />
</template>

<script>
export default {
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
    }
}
</script>