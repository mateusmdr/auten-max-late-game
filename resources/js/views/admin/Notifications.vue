<template>
    <Section title="Últimas notificações" icon="notifications">
        <AdminCreateNotificationModal/>
        <div class="input-container my-5">
            <div class="row">
                <div class="col-2">
                    <TextInput
                        label="Destinatário"
                        v-model="inputs.username"
                    />
                </div>
                <div class="col-1">
                    <DateInput v-model="inputs.date"/>
                </div>
                <div class="col-1">
                    <TimeInput v-model="inputs.time"/>
                </div>
                <div class="col-2">
                    <SearchInput
                        v-model="inputs.filter"
                    />
                </div>
            </div>
        </div>

        <AdminNotificationsTable
            :notifications="notifications"
        />
    </Section>
</template>

<script>
    export default {
        data: function() {
            return {
                inputs: {
                    name: null,
                    date: null,
                    time: null,
                    filter: null
                },
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

<style scoped>
    .img-home {
        width: 7vw;
        height: auto;
    }

</style>