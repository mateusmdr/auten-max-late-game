<template>
  <div class="thin-table">
        <Table
            defaultActionIcon='person'
            defaultActionText='Ver perfil'
            :actionWidth="2"
            :fields="fields"
            :items="users"
            :action="(user) => this.$router.push({ name: 'user', params: { id: user.id } })"
            :colorPicker="(user) => {
                if(user.isBlocked) {
                    return '#EB4263';
                }
                if(user.isInactive) {
                    return '#F5A847';
                }
                if(!user.isVerified) {
                    return '#B376F8';
                }

                return '#05F28E';
            }"
        />
    </div>
</template>

<script>
export default {
    props: {
        users: Array
    },
    created() {
        this.fields = [
            {name: '', value: 'name', width: 2},         
            {name: 'Email', value: 'email', width: 3},
            {name: 'CPF', value: 'cpf', width: 2},
            {name: 'Telefone', value: 'phone', width: 2},
            {name: 'Plano', value: 'plan', width: 1},
        ];
    }
}
</script>