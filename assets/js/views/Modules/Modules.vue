<template>
    <v-layout row wrap justify-start>
        <v-flex xs12 sm6 md4 lg3 v-for="module in modules" v-bind:key="module.alias">
            <module :module="module"></module>
        </v-flex>
    </v-layout>
</template>

<script>
    import Module from './Module'

    export default {
        name: 'Modules',
        components: {
            Module
        },
        data: () => ({
            language: ''
        }),
        created () {
            this.getModules()
        },
        watch: {
            '$route': 'getModules'
        },
        methods: {
            getModules() {
                this.language = this.$route.params.language
                this.$store.dispatch('Modules/getModules', this.language)
            }
        },

        computed: {
            modules () {
                return this.$store.getters['Modules/modules']
            }
        }
    }
</script>