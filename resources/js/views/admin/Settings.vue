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
                <AdminSettingsBanners/>
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
        this.steps = ['Planos', 'Torneios', 'Banners', 'Termos de uso']
    }
}
</script>
