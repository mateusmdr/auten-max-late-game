<template>
	<vue-final-modal v-model="showModal" classes="modal-container" content-class="modal-content">
		<a class="modal__close" @click="showModal = false">
			<Icon name="close"/>
		</a>
		<span class="modal__title mb-5">
			<Icon name="emoji_events"/>
			<h4 class="px-2 m-0">Novo Torneio</h4>
		</span>
		<div class="modal__content">
			<p>Vue Final Modal is a renderless, stackable, detachable and lightweight modal component.</p>
		</div>
	</vue-final-modal>
	<div class="absolute-top-right">
		<DynamicButton text="Cadastrar novo torneio" @click="showModal = true"/>
	</div>
</template>

<script>
export default {
	data() {
		return {
			showModal: true
		}
	}
}
</script>

<style scoped>
	a {
		cursor: pointer;
		color: #BFC9DB;
	}

	::v-deep .modal-container {
		display: flex;
		justify-content: center;
		align-items: center;
		width: 75vw;
		margin: auto;
	}

	.modal__title {
		color: #05F28E;
		display: flex;
		flex-direction: row;
		align-items: center;
	}

	.modal__title h4 {
		font-weight: 600;
	}

	.modal__close {
		position: absolute;
		top: 4rem;
		right: 2rem;

		transform: translate(-50%, -50%);
	}

	::v-deep .modal-content {
		background-color: #232323;
		border-radius: .5rem;
		padding: 4rem 2rem;
	}
</style>