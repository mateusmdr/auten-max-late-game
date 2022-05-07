<template>
    <form @submit.prevent="$emit('submit')" autocomplete="off">
        <h4 class="form-title mb-5">{{title}}</h4>
        <div class="input-container mb-3">
            <slot/>
        </div>
        <div class="submit-button-container">
            <DynamicButton
                v-if="showSubmitButton"
                :text="submitText"
            />
        </div>
    </form>
</template>

<script>
export default {
    emits: ['submit'],
    props: {
        showSubmitButton: {
            type: Boolean,
            default: false
        },
        title: String,
        submitText: String,
        submitHandler: Function
    }
}
</script>

<style scoped>
    form {
        background-color: #232323;
        border-radius: .5rem;
        padding: 4rem;
        position: relative;
        height: 100%;
    }

    .form-title {
        font-size: 1.125rem;
        font-weight: 400;
    }

    .submit-button-container {
        position: absolute;
        top: 100%;
        left: 50%;

        transform: translate(-50%, -50%);
    }
</style>