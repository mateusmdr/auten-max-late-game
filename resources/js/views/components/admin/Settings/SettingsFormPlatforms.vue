<template>
    <div class="form-container">
        <EditForm
            :showSubmitButton="false"
            title="Plataformas"
            submitText="Salvar edições"
            :submitHandler="(e) => {e.preventDefault;}"
        >
            <div class="row">
                <div class="col-4 mb-3" v-for="interval, index in intervals" :key="interval.id">
                    <DisabledInput
                        label=""
                        :value="`${interval} minutos`"
                        :hasIcon="true"
                        icon="delete"
                        :primary="false"
                    />
                </div>

                <div class="col-4 mb-3" v-if="confirm">
                    <NumberInput
                        name=""
                        v-model.number="inputs.interval"
                    />
                </div>
            </div>

            <AddButton
                :confirm="confirm"
                @click="handleAddButton"
            />
        </EditForm>
    </div>
</template>

<script>
export default {
    data() {
        return {
            confirm: false,
            inputs: {
                interval: 0
            },
        }
    },
    methods: {
        handleAddButton() {
            if(!this.confirm) {
                this.confirm = true;
                return;
            }

            if(this.inputs.interval <= 0) {
                alert('O intervalo deve maior que zero');
                return;
            }

            //TO-DO: cadastrar intervalo no banco
            if(!this.intervals.includes(this.inputs.interval)) {
                this.intervals = [...this.intervals, this.inputs.interval];
                this.confirm = false;
                this.inputs.interval = 0;
            }else {
                alert('Este intervalo já existe');
            }
        }
    }
}
</script>

<style scoped>
    .form-container {
        width: 45vw;
    }
</style>