<template>
    <div class="form-container">
        <EditForm
            :showSubmitButton="false"
            title="Intervalos de tempo de aviso"
            submitText="Salvar edições"
            :submitHandler="(e) => {e.preventDefault;}"
        >
            <div class="row">
                <div class="col-4 mb-3" v-for="interval in notificationIntervals" :key="interval.id">
                    <DisabledInput
                        label=""
                        :value="`${interval.minutes} minutos`"
                        :hasIcon="true"
                        icon="delete"
                        :primary="false"
                        @click="handleDelete(interval)"
                    />
                </div>

                <div class="col-4 mb-3" v-if="confirm">
                    <NumberInput
                        name=""
                        v-model.number="inputs.interval"
                        :error-message="errors.minutes"
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
import { storeToRefs } from 'pinia';
import {useNotificationIntervalStore} from '../../../../stores/admin';

export default {
    setup() {
        const notificationIntervalStore = useNotificationIntervalStore();
        notificationIntervalStore.refresh();

        const {notificationIntervals} = storeToRefs(notificationIntervalStore);
        return {
            notificationIntervals,
            notificationIntervalStore
        }
    },
    data() {
        return {
            confirm: false,
            inputs: {
                interval: 0
            },
            errors: {
                minutes: null
            }
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

            axios
                .post('/api/notification_interval', {minutes: this.inputs.interval})
                .then(() => {this.inputs.interval = 0; this.confirm = false})
                .catch(res => this.errors = res.response.data.errors)
                .finally(this.notificationIntervalStore.refresh);
        },
        handleDelete(interval) {
            const res = confirm("Tem certeza que quer remover o intervalo de " + interval.minutes + " minutos?");

            if(!res) {
                return;
            }

            axios
                .delete('/api/notification_interval/' + interval.id)
                .catch(res => alert(res.response.data.errors[0]))
                .finally(this.notificationIntervalStore.refresh);
        }
    }
}
</script>

<style scoped>
    .form-container {
        width: 55vw;
    }
</style>