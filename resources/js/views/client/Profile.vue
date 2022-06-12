<template>
    <Section title="Perfil" icon="person">
        <Stepper :steps="steps" :defaultStep="isRegular ? 0 : 1">
            <template #step-0>
                <ClientProfileFormPersonal/>
            </template>
            <template #step-1>
                <div class="d-flex flex-row justify-content-stretch">
                    <ClientProfileFormPayment1/>
                    <ClientProfileFormPayment2/>
                </div>
            </template>
        </Stepper>
    </Section>
</template>

<script>

export default {
    created() {
        this.steps = ["Dados pessoais", "Plano e Pagamento"];

        this.isRegular = this.user.isRegular;
    },
}
</script>