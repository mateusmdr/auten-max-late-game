<template>
    <Section title="Usuários cadastrados" icon="person">
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

        <div class="thin-table">
            <Table
                defaultActionIcon='person'
                defaultActionText='Ver perfil'
                :fields="userFields"
                :items="users"
            />
        </div>
    </Section>
</template>

<script>
    import Section from '../components/Section.vue';
    import RadioChips from '../components/RadioChips.vue';
    import Select from '../components/Select.vue';
    import SearchInput from '../components/SearchInput.vue';
    import Table from '../components/Table.vue';

    export default {
        components: {
            Section,
            RadioChips,
            Select,
            SearchInput,
            Table
        },
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
                userFields: [                    
                    {name: 'Email', width: 3},
                    {name: 'CPF', width: 2},
                    {name: 'Telefone', width: 2},
                    {name: 'Plano', width: 2},
                ],
                users: Array(4).fill(
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
                        defaultAction: () => console.log("fui clicado")
                    }
                )
            }
        }
    }
</script>

<style scoped>
    .img-home {
        width: 7vw;
        height: auto;
    }
    .thin-table {
        width: 88%;
    }

</style>