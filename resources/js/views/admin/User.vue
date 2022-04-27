<template>
    <Section title="Usuários cadastrados" icon="person">
        <h1>ID: {{user.id}}</h1>
    </Section>
</template>

<script>
export default {
    created() {
        this.user = {
            id: this.$route.params.id
        };
    },
}
</script>

<style>

</style>