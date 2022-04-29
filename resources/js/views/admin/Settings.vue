<template>
    <Section title="Configurações" icon="settings">
        <Stepper :steps="steps">
            <template #step-0>
                Planos
            </template>
            <template #step-1>
                Notificações
            </template>
            <template #step-2>
                Torneios
            </template>
            <template #step-3>
                Termos de uso
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