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
        mounted() {
            axios
                .get('/api/user')
                .then(response => {
                    console.log(response);
                    this.users = response.data.data;                    
                })
                .catch(error => {
                    console.error(error)
                });
        },
        data: function() {
            return {
                users: null
            }
        }
    }
</script>