<template>
    <section class="mb-5 container-fluid position-relative">
        <div class="mb-3">
            <Icon :name="icon"/>
        </div>
        <h3>{{title}}</h3>
        <h4>{{description}}</h4>
        <div class="mt-5">
            <slot/>
        </div>
    </section>
</template>

<script>
export default {
    props: {
        icon: String,
        title: String,
        description: String
    }
}
</script>

<style scoped>
    section {
        width: calc(100% - 8rem);
        margin: auto;
    }
</style>