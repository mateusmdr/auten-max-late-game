<template>
    <div class="form-container">
        <EditForm
            :showSubmitButton="fileSelected"
            submitText="Atualizar termos"
            :submitHandler="(e) => {e.preventDefault;}"
        >
            <div class="row">
                <div class="col-12 mb-4">
                    <TextInput
                        label="Termos de uso"
                        v-model="inputs.file"
                        :hasIcon="true"
                        icon="attach_file"
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
            fileSelected: true,
            inputs: {
                file: 'termos_de_uso.pdf'
            }
        }
    },
}
</script>

<style scoped>
    .form-container {
        width: 25vw;
    }
</style>