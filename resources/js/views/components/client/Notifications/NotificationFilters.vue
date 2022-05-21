<template>
    <RadioChips
        :chips="notificationTypes"
        v-model="inputs.notificationType"
    />
</template>

<script>
export default {
    emits: ['change'],
    created() {
        this.notificationTypes = [
            {
                id: 0,
                text:'Todos',
                hasIcon: false,
            },
            {
                id: 1,
                text:'Torneios',
                color:'#B376F8',
            },
            {
                id: 2,
                text:'Admnistração',
                color:'#F5A847',
            },
            {
                id: 3,
                text:'Financeiro',
                color:'#05F28E',
            }
        ];
    },
    watch: {
        inputs: {
            handler(before, now) {
                const newFilter = (notification) => {
                    let notificationTypeFilter = true;
                    switch(now.notificationType) {
                        case 1:
                            notificationTypeFilter = notification.type === 'tournament';
                            break;
                        case 2:
                            notificationTypeFilter = notification.type === 'administrative';
                            break;
                        case 3:
                            notificationTypeFilter = notification.type === 'financial';
                    }

                    return (
                        notificationTypeFilter
                    );
                };

                this.$emit('change',newFilter);
            },
            deep: true
        }
    },
    data() {
        return {
            inputs: {
                notificationType: 0,
            }
        }
    }
}
</script>

<style>

</style>