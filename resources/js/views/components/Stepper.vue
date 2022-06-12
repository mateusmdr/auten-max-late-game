<template>
    <nav class="step-nav d-flex flex-row mb-5 gap-5">
        <FormStep
            v-for="step, index in steps"
            :key="index"
            :text="step"
            :selected="index === currentStep"
            @click="this.currentStep = index"
        />
    </nav>
    <div class="custom-stepper">
        <slot :name="'step-'+currentStep"/>
    </div>
</template>

<script>
export default {
    props: {
        steps: Array,
        defaultStep: {
            type: Number,
            default: 0
        }
    },
    data() {
        return {
            currentStep: this.defaultStep
        }
    }
}
</script>

<style>

</style>