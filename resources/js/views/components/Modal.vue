<template>
	<vue-final-modal v-model="showModal" classes="modal-container" :styles="{padding: `0 ${(100-width)/2}vw`}" content-class="modal-content" @before-close="$emit('close')">
		<form @submit.prevent="$emit('submit')" autocomplete="off">
			<a class="modal__close" @click="closeModal">
				<Icon name="close"/>
			</a>
			<span class="modal__title mb-5" :style="`color: ${titleColor};`">
				<Icon :name="modalIcon"/>
				<h4 class="px-2 m-0">{{modalTitle}}</h4>
			</span>
			<div class="modal__content mb-5">
				<slot/>
			</div>
			<div class="submit-button" v-if="!noSubmit">
				<DynamicButton :text="submitModalText"/>
			</div>

			<div class="d-flex justify-content-around flex-row">
				<DynamicButton text="Não" @click="closeModal" :primary="false" v-if="confirm"/>
				<DynamicButton text="Sim" v-if="confirm"/>
			</div>
			
		</form>
	</vue-final-modal>
	<div class="absolute-top-right" v-if="!noButton">
		<DynamicButton :text="openModalText" @click="showModal = true"/>
	</div>
</template>

<script>
export default {
	emits: ['submit','open','close'],
    props: {
        openModalText: String,
        modalTitle: String,
        modalIcon: String,
        submitModalText: String,
		titleColor: {
			type: String,
			default: '#05F28E',
		},
		width: {
			type: Number,
			default: 75
		},
		noButton: {
			type: Boolean,
			default: false
		},
		noSubmit: {
			type: Boolean,
			default: false
		},
		confirm: {
			type: Boolean,
			default: false
		}
    },
	data() {
		return {
			showModal: false
		}
	},
	methods: {
		closeModal() {
			this.showModal = false;
			this.$emit('close');
		},
		openModal() {
			this.showModal = true;
			this.$emit('open');
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
		margin: auto;
	}

	.modal__title {
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

    .submit-button {
        position: absolute;
        left: 50%;
		bottom: 0;
        transform: translate(-50%, -50%);
    }
</style>