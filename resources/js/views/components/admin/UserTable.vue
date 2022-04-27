<template>
  <div class="thin-table">
        <Table
            defaultActionIcon='person'
            defaultActionText='Ver perfil'
            :actionWidth="2"
            :fields="userFields"
            :items="userRows"
        />
    </div>
</template>

<script>
export default {
    props: {
        users: Array
    },
    computed: {
        userRows() {
            return this.users.map(user => {
                return(
                    {
                        ...user,
                        action: () => this.$router.push({ name: 'user', params: { id: user.id } })
                    }
                );
            })
        }
    },
    created() {
        this.userFields = [                    
            {name: 'Email', width: 2},
            {name: 'CPF', width: 2},
            {name: 'Telefone', width: 2},
            {name: 'Plano', width: 2},
        ];
    }
}
</script>

<style>
    .thin-table {
        width: 88%;
    }
</style>