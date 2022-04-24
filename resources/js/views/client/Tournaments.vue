<template>
    <Section title="Torneios" description="Próximos Torneios" icon="emoji_events">
    </Section>
</template>

<script>
    import Section from '../components/Section.vue';

    export default {
        components: {
            Section
        },
        data: function() {
            return {
                tournaments: Array(8).fill(
                    {
                        id: 1,
                        title: 'Título do torneio',
                        color: '#05F28E',
                        values: [
                            '00/00/0000',
                            '00h00 às 00h00',
                            'Party Poker',
                            'Cash Game',
                            '$ 0000,00',
                            '$ 000000,00',
                            'R$ 00000,00'
                        ],
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

</style>