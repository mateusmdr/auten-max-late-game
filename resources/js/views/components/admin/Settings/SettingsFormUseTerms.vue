<template>
    <div class="form-container">
        <EditForm
            :showSubmitButton="!!inputs.file"
            submitText="Atualizar termos"
            @submit="upload"
        >
            <div class="row">
                <div class="col-12 mb-4">
                    <FileInput
                        label="Termos de uso"
                        @change="(file) => inputs.file = file"
                        hint="Apenas arquivos .pdf"
                        mime="application/pdf"
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
                file: null
            }
        }
    },
    methods: {
        upload() {
            const formData = new FormData();
            formData.append('file', this.inputs.file);
            axios
                .post('/api/eula', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(() => this.inputs.file = null)
                .then(() => alert("Termos de uso atualizados com sucesso!"))
        }
    }
}
</script>

<style scoped>
    .form-container {
        width: 25vw;
    }
</style>