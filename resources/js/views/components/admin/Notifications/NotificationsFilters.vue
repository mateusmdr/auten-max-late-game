<template>
    <div class="input-container my-5">
        <div class="row">
            <div class="col-2">
                <TextInput
                    label="Destinatário"
                    v-model="inputs.username"
                />
            </div>
            <div class="col-2">
                <DateInput v-model="inputs.date" :minDate="false"/>
            </div>
            <div class="col-2">
                <TimeInput v-model="inputs.time"/>
            </div>
            <div class="col-2">
                <SearchInput
                    v-model="inputs.search"
                />
            </div>
        </div>
    </div>
</template>

<script>
import {format} from 'date-format-parse';

export default {
    data() {
        return {
            inputs: {
                name: null,
                date: null,
                time: null,
                search: null
            }
        }
    },
    watch: {
        inputs: {
            handler(before, now) {
                const newFilter = (notification) => {

                    const search1 = (notification.user_name).toLowerCase();
                    const search2 = notification.description ? (notification.description).toLowerCase() : "";

                    return (
                        (now.username ? search1.includes(now.username.toLowerCase()) : true) &&
                        (now.search ? search2.includes(now.search.toLowerCase()) : true) &&
                        (now.date ? notification.date === format(now.date, 'DD/MM/YYYY') : true) &&
                        (now.time ? notification.time === now.time : true)
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
