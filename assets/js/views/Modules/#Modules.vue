<template>
    <v-container grid-list-xl fluid> 
        <v-layout row wrap>
            <v-flex xs12 sm6 md4 v-for="module in modules" v-bind:key="module.alias">
                <module :module="module"></module>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import Module from './Module'
    export default {
        name: 'Modules',
        components: {
            Module
        },
        data: () => ({
        }),
        created () {
            let language = this.$route.params.language
            this.$store.dispatch('ModulesStore/getModules', language)
        },
        computed: {
            modules () {
                return this.$store.getters['ModulesStore/modules']
            }
        }
    }
</script>