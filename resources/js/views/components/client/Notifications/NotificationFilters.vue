<template>
    <RadioChips
        :chips="notificationTypes"
        v-model="notificationType"
    />
</template>

<script>
export default {
    emits: ['change'],
    created() {
        this.notificationTypes = [
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
        ];
    },
    watch: {
        inputs: {
            handler(before, now) {
                const newFilter = (notification) => {
                    return (
                        true
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