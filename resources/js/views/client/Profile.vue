<template>
    <Section title="Perfil" icon="person">
        <Stepper :steps="steps">
            <template #step-0>
                <ClientProfileFormPersonal/>
            </template>
            <template #step-1>
                <ClientProfileFormPayment/>
            </template>
        </Stepper>
    </Section>
</template>

<script>
    export default {
        created() {
            this.steps = ["Dados pessoais", "Plano e Pagamento"];
        },
    }
</script>