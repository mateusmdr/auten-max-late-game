<template>
	<Modal
		openModalText="Cadastrar novo banner"
        modalTitle= "Novo Banner"
        modalIcon= "picture_in_picture"
        submitModalText= "Cadastrar"
        :width="40"
        @submit="submit"
        ref="modal"
	>
        <div class="row mb-3">
            <div class="col-6">
                <TextInput
                    label="Título *"
                    v-model="inputs.title"
                />
            </div>
            <div class="col-6">
                <FileInput
                    label="Imagem do banner *"
                    @change="(img) => inputs.img = img"
                    hint="Selecione uma imagem .png ou .jpg."
                    mime="image/jpeg,image/png"
                />
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-4">
                <Select
                    :options="availablePositions"
                    v-model="inputs.position"
                    name="Posição *"
                />
            </div>
            <div class="col-8">
                <TextInput
                    label="Link do banner *"
                    v-model="inputs.link_url"
                    hasIcon
                    icon="link"
                />
            </div>
        </div>
    </Modal>
</template>

<script>
import {
    useBannerStore
} from '../../../../stores/admin';
import {mapState, mapStores} from 'pinia';

export default {
    created() {
        this.positions = [
            {name: '1', id: 1},
            {name: '2', id: 2},
            {name: '3', id: 3},
            {name: '4', id: 4},
            {name: '5', id: 5},
        ]
        this.bannerStore.refresh();
    },
    data() {
        return {
            inputs: {
                title: null,
                position: null,
                img: null,
                link_url: null,
            }
        }
    },
    computed: {
        ...mapState(useBannerStore, ['banners']),
        ...mapStores(useBannerStore),
        availablePositions() {
            return this.positions.filter(({id}) =>
                !this.banners.map(b => b.position).includes(id)
            );
        }
    },
    methods: {
        submit() {
            const formData = new FormData();

            for ( let key in this.inputs ) {
                formData.append(key, this.inputs[key]);
            }

            axios
                .post('/api/banner',
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
                        title: null,
                        position: null,
                        img: null,
                        link_url: null,
                    }
				})
                .catch(res => {alert("Verifique os dados inseridos.")})
                .finally(this.bannerStore.refresh);
        }
    }
}
</script>

<style scoped>
    h4 {
        font-weight: 400;
        color: #E2E2FF;
    }

    h5 {
        color: #E2E2FF;
    }
</style>
