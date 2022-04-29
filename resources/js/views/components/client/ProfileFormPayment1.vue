<template>
    <div class="form-container">
        <EditForm
            :showSubmitButton="true"
            title="Planos"
            submitText="Salvar edições"
            :submitHandler="(e) => {e.preventDefault;}"
        >
            <p class="mb-5">
                Todos os planos liberam o acesso completo à plataforma
            </p>
            <RadioGroup
                :options="paymentPlans"
                v-model="inputs.paymentPlan"
            />
        </EditForm>
    </div>
</template>

<script>
export default {
    created() {
        this.paymentPlans = [
            {
                value: 'yearly',
                text: 'Anual - R$ 199,00',
            },
            {
                value: 'biannual',
                text: 'Semestral - R$ 119,99',
            },
            {
                value: 'monthly',
                text: 'Mensal - R$ 29,99',
            }
        ];
    },
    data() {
        return {
            inputs: {
                paymentPlan: 0
            }
        }
    }
}
</script>

<style>
    .form-container {
        width: calc(4/12 * 100% - 4rem);
        margin-right: 4rem;
    }

    .form-container p {
        font-weight: 400;
        color: #BFC9DB;
        font-size: 1rem;
    }
</style>