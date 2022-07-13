<template>
    <Section title="Configurações" icon="settings">
        <Stepper :steps="steps">
            <template #step-0>
                <AdminSettingsFormPlans/>
            </template>
            <template #step-1>
                <div class="d-flex flex-row align-items-start">
                    <AdminSettingsFormTournaments1/>
                    <AdminSettingsFormTournaments2/>
                </div>
            </template>
            <template #step-2>
                <AdminSettingsFormUseTerms/>
            </template>
        </Stepper>
    </Section>
</template>

<script>
export default {
    created() {
        this.steps = ['Planos', 'Notificações', 'Torneios', 'Termos de uso']
    }
}
</script>