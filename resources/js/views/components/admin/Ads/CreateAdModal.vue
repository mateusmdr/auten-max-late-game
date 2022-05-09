<template>
	<Modal
		openModalText="Cadastrar novo anúncio"
        modalTitle= "Novo Anúncio"
        modalIcon= "picture_in_picture"
        submitModalText= "Cadastrar"
		:width="50"
		ref="modal"
		@submit="submit"
	>
		<div class="row mb-4">
			<div class="col-4">
				<TextInput
					label="Nome do cliente *"
					v-model="inputs.company_name"
					:error-message="errors.company_name"
				/>
			</div>
			<div class="col-3">
				<DateInput
					label="Data início *"
					v-model="inputs.begin_at"
					:error-message="errors.begin_at"
				/>
			</div>
			<div class="col-3">
				<DateInput
					label="Data fim *"
					v-model="inputs.end_at"
					:error-message="errors.end_at"
				/>
			</div>
			<div class="col-2">
				<TextInput
					label="Valor (R$) *"
					v-model="inputs.price"
					:error-message="errors.price"
				/>
			</div>
		</div>
		<div class="row mb-4">
			<div class="col-4">
				<FileInput
					label="Imagem do anúncio *"
					@change="(img) => inputs.img = img"
					hint="Selecione uma imagem .png ou .jpg com resolução de 1312 x 168 px."
					:error-message="errors.img"
					mime="image/jpeg,image/png"
				/>
			</div>
			<div class="col-8">
				<TextInput
					label="Link do anúncio *"
					v-model="inputs.link_url"
					hasIcon
					icon="link"
					:error-message="errors.link_url"
				/>
			</div>
		</div>
	</Modal>
</template>

<script>
import { format } from 'date-format-parse';

import {useAdStore} from '../../../../stores/admin';

export default {
	setup() {
        const adStore = useAdStore();

        return {
            adStore
        }
    },
	data() {
		return {
			inputs: {
				company_name: "",
				begin_at: null,
				end_at: null,
				price: "",
				link_url: "",
				img: null,
			},
			errors: {
				company_name: null,
				begin_at: null,
				end_at: null,
				price: null,
				link_url: null,
				img: null,
			}
		}
	},
	methods: {
		submit() {
			const formData = new FormData();
            formData.append('img', this.inputs.img);
			
			const inputData = {
				...this.inputs,
				price: this.inputs.price.replace(/[^\d.-]/g, ''),
				begin_at: format(this.inputs.begin_at, 'YYYY-MM-DD'),
				end_at: format(this.inputs.end_at, 'YYYY-MM-DD'),
			};

			for ( let key in inputData ) {
				formData.append(key, inputData[key]);
			}

			axios
				.post(
					'/api/ad', 
					formData,
					{
						headers: {
							'Content-Type': 'multipart/form-data'
						}
					}
				)
                .then(this.$refs.modal.closeModal)
				.then(() => {
					this.inputs = {
						company_name: "",
						begin_at: new Date(),
						end_at: null,
						price: "",
						link_url: "",
						img: null,
					}
				})
                .catch(res => this.errors = res.response.data.errors)
                .finally(() => this.adStore.refresh());
        }
    }
}
</script>

<style scoped>
</style>