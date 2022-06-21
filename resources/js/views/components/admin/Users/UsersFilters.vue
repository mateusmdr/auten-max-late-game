<template>
    <RadioChips
        :chips="userStatuses"
        v-model="inputs.userStatus"
    />
    <div class="input-container my-5">
        <div class="row">
            <div class="col-2">
                <SearchInput
                    v-model="inputs.search"
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
    emits: ['change'],
    created() {
        this.userStatuses = [
            {
                id: 0,
                text:'Todos',
                hasIcon: false,
            },
            {
                id: 1,
                text:'Cadastrados',
                color:'#05F28E',
            },
            {
                id: 2,
                text:'Email não verificado',
                color:'#B376F8',
            },
            {
                id: 3,
                text:'Inativos',
                color:'#F5A847',
            },
            {
                id: 4,
                text:'Bloqueados',
                color:'#EB4263',
            }
        ];

        this.paymentPlans = [
            {
                name: 'Gratuito',
                id:'free'
            },
            {
                name: 'Mensal',
                id: 'monthly'
            },
            {
                name: 'Semestral',
                id: 'biannual'
            },
            {
                name: 'Anual',
                id: 'yearly'
            }
        ];
    },
    watch: {
        inputs: {
            handler(before, now) {
                const newFilter = (user) => {

                    let userStatusFilter = true;
                    switch(now.userStatus) {
                        case 0:
                            userStatusFilter = true;
                        case 1:
                            userStatusFilter = user.isVerified;
                            break;
                        case 2:
                            userStatusFilter = !user.isVerified;
                            break;
                        case 3:
                            userStatusFilter = user.isInactive;
                            break;
                        case 4:
                            userStatusFilter = user.isBlocked;
                    }

                    const search = (user.name + user.email + user.cpf + user.phone).toLowerCase();
                    return (
                        userStatusFilter &&
                        (now.search ? search.includes(now.search.toLowerCase()) : true) &&
                        (now.paymentPlan ? user.plan_period == now.paymentPlan : true)
                    );
                };

                this.$emit('change',newFilter);
            },
            deep: true
        }
    },
    data() {
        return {
            inputs: {
                userStatus: 0,
                search: null,                
                paymentPlan: null,
            }
        }
    }
}
</script>

<style>

</style>