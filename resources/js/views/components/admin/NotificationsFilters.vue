<template>
    <div class="input-container my-5">
        <div class="row">
            <div class="col-2">
                <TextInput
                    label="Destinatário"
                    v-model="inputs.username"
                />
            </div>
            <div class="col-1">
                <DateInput v-model="inputs.date"/>
            </div>
            <div class="col-1">
                <TimeInput v-model="inputs.time"/>
            </div>
            <div class="col-2">
                <SearchInput
                    v-model="inputs.filter"
                />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            inputs: {
                name: null,
                date: null,
                time: null,
                filter: null
            }
        }
    }
}
</script>

<style>

</style>