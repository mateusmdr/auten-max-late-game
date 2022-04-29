<template>
    <div class="form-container">
        <EditForm
            :showSubmitButton="true"
            title="Planos"
            submitText="Salvar edições"
            :submitHandler="(e) => {e.preventDefault;}"
        >
            <div class="row mb-3">
                <div class="col-5">
                    <DisabledInput
                        label="Tipo"
                        value="Mensal"
                    />
                </div>
                <div class="col-7">
                    <NumberInput
                        name="Valor"
                        v-model="inputs.monthly"
                    />
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-5">
                    <DisabledInput
                        label="Tipo"
                        value="Semestral"
                    />
                </div>
                <div class="col-7">
                    <NumberInput
                        name="Valor"
                        v-model="inputs.biannual"
                    />
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-5">
                    <DisabledInput
                        label="Tipo"
                        value="Anual"
                    />
                </div>
                <div class="col-7">
                    <NumberInput
                        name="Valor"
                        v-model="inputs.yearly"
                    />
                </div>
            </div>
        </EditForm>
    </div>
</template>

<script>
export default {
    data() {
        return {
            inputs: {
                monthly: null,
                biannual: null,
                yearly: null
            },
        }
    }
}
</script>

<style scoped>
    .form-container {
        display: inline-block;
    }
</style>