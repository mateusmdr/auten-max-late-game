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
        steps: Array
    },
    data() {
        return {
            currentStep: 0
        }
    }
}
</script>

<style>

</style>