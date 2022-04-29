<template>
    <RadioChips
        :chips="paymentStatuses"
        v-model="inputs.paymentStatus"
    />
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
    created() {
        this.paymentStatuses = [
            {
                text:'Todos',
                hasIcon: false,
            },
            {
                text:'Mensal',
                color:'#B376F8',
            },
            {
                text:'Semanal',
                color:'#F5A847',
            },
            {
                text:'Anual',
                color:'#05F28E',
            },{
                text: 'Pendentes',
                color: '#EB4263'
            }
        ];
    },
    data() {
        return {
            inputs: {
                paymentStatus: 0,
                date: null,
                time: null,
                filter: null,
            },
        }
    }
}
</script>

<style>

</style>