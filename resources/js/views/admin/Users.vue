<template>
    <Section title="Usuários cadastrados" icon="person">
        <AdminCreateUserModal/>
        <RadioChips
            :chips="userStatuses"
            :value="userStatusId"
            @input="(id) => {userStatusId = id}"
        />
        <div class="input-container my-5">
            <div class="row">
                <div class="col-2">
                    <SearchInput
                        v-model="filter"
                    />
                </div>
                <div class="col-2">
                    <Select 
                        :options="paymentPlans"
                        v-model="paymentPlan"
                        name="Tipo de plano"
                    />
                </div>
            </div>            
        </div>

        <AdminUsersTable
            :users="users"
        />
    </Section>
</template>

<script>
    export default {
        data: function() {
            return {
                userStatusId: 0,
                userStatuses: [
                    {
                        id: 0,
                        text:'Cadastrados',
                        color:'#B376F8',
                    },
                    {
                        id: 1,
                        text:'Inativos',
                        color:'#F5A847',
                    },
                    {
                        id: 2,
                        text:'Bloqueados',
                        color:'#EB4263',
                    }
                ],
                filter: null,
                paymentPlans: [
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
                ],
                paymentPlan: null,
                users: [
                    {
                        id: 1,
                        title: 'Nome do usuário',
                        color: '#B376F8',
                        values: [
                            'email@email.com',
                            '000.000.000-00',
                            '(00) 00000-0000',
                            'Mensal',
                        ],
                        isEditable: false,
                    },
                    {
                        id: 2,
                        title: 'Nome do usuário',
                        color: '#B376F8',
                        values: [
                            'email@email.com',
                            '000.000.000-00',
                            '(00) 00000-0000',
                            'Mensal',
                        ],
                        isEditable: false,
                    },
                    {
                        id: 3,
                        title: 'Nome do usuário',
                        color: '#B376F8',
                        values: [
                            'email@email.com',
                            '000.000.000-00',
                            '(00) 00000-0000',
                            'Mensal',
                        ],
                        isEditable: false,
                    }
                ]
            }
        }
    }
</script>

<style scoped>
    .img-home {
        width: 7vw;
        height: auto;
    }
</style>