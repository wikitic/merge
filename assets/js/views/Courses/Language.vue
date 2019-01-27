<template>
    <v-layout row wrap justify-start>
        <v-flex xs12 sm6 md4 lg3 v-for="module in modules" v-bind:key="module.alias">
            <module :language="language" :module="module"></module>
        </v-flex>
    </v-layout>
</template>

<script>
    import Module from '../../components/Courses/Module'

    export default {
        name: 'language',
        components: {
            Module
        },
        data: () => ({
        }),
        created () {
            this.getLanguage()
        },
        watch: {
            '$route': 'getLanguage'
        },
        methods: {
            getLanguage() {
                let payload = { alias: this.$route.params.language }
                this.$store.dispatch('Language/getLanguage', payload)
            }
        },
        computed: {
            language () {
                return this.$store.getters['Language/language']
            },
            modules () {
                return this.$store.getters['Language/language'].modules
            }
        }
    }
</script>