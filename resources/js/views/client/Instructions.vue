<template>
    <Section title="Notificações" description="Instruções de uso da plataforma" icon="notifications">
        <router-link :to="{name: 'notifications'}" class="return-button">
            <Icon name="navigate_before" color="#7F8896"/>
            <span class="return-button">Voltar</span>
        </router-link>

        <div class="instructions my-5">
            <h4>Não perca as notificações</h4>
            <h5>Permita e gerencie as notificações pelo seu computador.</h5>
        </div>

        <Stepper :steps="steps" :defaultStep="0">
            <template #step-0>
                <ClientNotificationPermissions/>
            </template>
            <template #step-1>
                <ClientNotificationTime/>
            </template>
        </Stepper>
    </Section>
</template>

<script>
export default{
    created() {
        this.steps = ["Permissão de notificação", "Tempo de notificação"];
    },
}
</script>

<style scoped lang="scss">
    .return-button {
        color: #BFC9DB;
        font-weight: 600;
        font-size: 16px;
        text-decoration: none;
    }

    .instructions {
        background-color: #232323;
        border-radius: 8px;
        padding: 24px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        flex-direction: column;
        h4 {
            font-weight: 700;
            font-size: 16px;
            color: #BFC9DB;
        }
        h5 {
            font-weight: 600;
            font-size: 16px;
            color: #7F8896;
        }
    }
</style>