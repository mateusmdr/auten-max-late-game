<template>
	<Modal
		openModalText="Enviar nova notificação"
        modalTitle= "Nova notificação"
        modalIcon= "notifications"
        submitModalText= "Enviar"
		@submit="submit"
		:width="50"
        ref="modal"
	>
		<div class="row mb-3">
            <div class="col-4">
                <Select 
                    :options="[
						{id: 'administrative', name: 'Administração'},
						{id: 'financial', name: 'Financeiro'}
					]"
                    v-model="inputs.type"
                    name="Categoria *"
					:error-message="errors.type"
                />
            </div>
        </div>
		<div class="row mb-3">
            <div class="col-6">
                <Select 
                    :options="users"
                    v-model="inputs.user_id"
                    name="Destinatário"
					defaultText="Todos"
					:error-message="errors.user_id"
                />
            </div>
			<div class="col-4">
                <DateInput 
                    v-model="inputs.date"
                    label="Data *"
					:error-message="errors.datetime"
                />
			</div>
			<div class="col-2">
                <TimeInput 
                    label="Hora *"
                    v-model="inputs.time"
					:error-message="errors.datetime"
                />
            </div>
        </div>
		<div class="row mb-3">
            <div class="col-12">
                <TextInput 
                    v-model="inputs.description"
                    name="Mensagem *"
					:error-message="errors.type"
					multiline
                />
            </div>
        </div>
	</Modal>
</template>

<script>
import { storeToRefs } from 'pinia';
import { useUserStore, useNotificationStore } from '../../../../stores/admin';

export default {
    setup() {
        const userStore = useUserStore();
        userStore.refresh();

		const notificationStore = useNotificationStore();

        const {users} = storeToRefs(userStore);
        return {
            users,
			notificationStore
        }
    },
	data() {
        return {
            inputs: {
                type: 'administrative',
				user_id: null,
				date: new Date(),
				time: new Date(),
				description: null,
            },
            errors: {
                type: null,
            }
        }
    },
	methods: {
        submit() {
			if(!this.inputs.user_id) {
				const res = confirm("Tem certeza que deseja enviar uma mensagem para TODOS os usuários cadastrados?");
				if(!res) return;
			}
            const time = this.inputs.time;
            axios
                .post('/api/notification', {
					type: this.inputs.type,
					user_id: !this.inputs.user_id ? undefined : this.inputs.user_id,
					datetime: this.inputs.date.toISOString().slice(0, 10) + ' ' + time.toISOString().slice(11, 16),
					description:  this.inputs.description,
				})
                .then(this.$refs.modal.closeModal)
				.then(() => {
					this.inputs = {
						type: 'administrative',
						user_id: null,
						date: new Date(),
						time: new Date(),
						description: null,
					}
				})
                .catch(res => this.errors = res.response.data.errors)
                .finally(this.notificationStore.refresh);
        }
    }
}
</script>

<style scoped>
</style>