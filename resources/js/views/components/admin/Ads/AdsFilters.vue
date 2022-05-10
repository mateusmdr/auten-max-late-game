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
import {format, parse} from 'date-format-parse';

export default {
    emits: ['change'],
    data() {
        return {
            inputs: {
                date: null,
                name: null
            }
        }
    },
    watch: {
        inputs: {
            handler(before, now) {
                const newFilter = (ad) => {

                    const search = (ad.company_name).toLowerCase();

                    return (
                        (now.name ? search.includes(now.name.toLowerCase()) : true) &&
                        (now.date ? parse(ad.begin_at, 'DD/MM/YYYY') <= now.date && parse(ad.end_at, 'DD/MM/YYYY') >= now.date : true)
                    );
                };

                this.$emit('change',newFilter);
            },
            deep: true
        }
    },
}
</script>

<style>

</style>