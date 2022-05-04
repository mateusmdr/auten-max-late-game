<template>
    <Section title="Configurações" icon="settings">
        <Stepper :steps="steps">
            <template #step-0>
                <AdminSettingsFormPlans/>
            </template>
            <template #step-1>
                <AdminSettingsFormNotifications/>
            </template>
            <template #step-2>
                <AdminSettingsFormTournaments/>
            </template>
            <template #step-3>
                <AdminSettingsFormUseTerms/>
            </template>
        </Stepper>
    </Section>
</template>

<script>
export default {
    created() {
        this.steps = ['Planos', 'Notificações', 'Torneios', 'Termos de uso']
    },
    data() {
        return {

        }
    }
}
</script>