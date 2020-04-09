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

<style lang="scss" scoped>

</style>
