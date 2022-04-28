<template>    
    <div class="input-container my-5">
        <div class="row">
            <div class="col-2">
                <TextInput 
                    v-model="inputs.name"
                    name="Nome"
                />
            </div>
            <div class="col-1">
                <DateInput v-model="inputs.date"/>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    emits: ['change'],
    watch: {
        inputs(before, now) {
            console.log(now);
            this.$emit('change',now);
        }
    },
    data() {
        return {
            inputs: {
                date: null,
                name: null
            }
        }
    }
}
</script>

<style>

</style>