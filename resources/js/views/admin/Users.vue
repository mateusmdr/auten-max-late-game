<template>
    <Section title="Usuários cadastrados" icon="person">
        <AdminCreateUserModal/>
        
        <AdminUsersFilters/>

        <AdminUsersTable
            :users="users"
        />
    </Section>
</template>

<script>
    export default {
        data: function() {
            return {
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