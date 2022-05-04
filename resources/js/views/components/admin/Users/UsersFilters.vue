<template>
    <RadioChips
        :chips="userStatuses"
        v-model="inputs.userStatus"
    />
    <div class="input-container my-5">
        <div class="row">
            <div class="col-2">
                <SearchInput
                    v-model="inputs.filter"
                />
            </div>
            <div class="col-2">
                <Select 
                    :options="paymentPlans"
                    v-model="inputs.paymentPlan"
                    name="Tipo de plano"
                />
            </div>
        </div>            
    </div>
</template>

<script>
export default {
    created() {
        this.userStatuses = [
            {
                id: 0,
                text:'Cadastrados',
                color:'#05F28E',
            },
            {
                id: 1,
                text:'Email não verificado',
                color:'#B376F8',
            },
            {
                id: 2,
                text:'Inativos',
                color:'#F5A847',
            },
            {
                id: 3,
                text:'Bloqueados',
                color:'#EB4263',
            }
        ];

        this.paymentPlans = [
            {
                name: 'Gratuito',
                value:'free'
            },
            {
                name: 'Mensal',
                value:'monthly'
            },
            {
                name: 'Semestral',
                value:'biannual'
            },
            {
                name: 'Anual',
                value:'yearly'
            }
        ];
    },
    data() {
        return {
            inputs: {
                userStatus: 0,
                filter: null,                
                paymentPlan: null,
            }
        }
    }
}
</script>

<style>

</style>