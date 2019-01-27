<template>
    <v-layout row wrap justify-start>
        <MenuLessons :language="language" :module="module" :lessons="lessons"></MenuLessons>
        <!--
        <v-flex xs12 sm6 md4 lg3 v-for="lesson in lessons" v-bind:key="lesson.alias">
            <lesson :language="language" :module="module" :lesson="lesson"></lesson>
        </v-flex>
        -->
    </v-layout>
</template>

<script>
    //import Lesson from '../../components/Courses/Lesson'
    import MenuLessons from '../../components/Courses/MenuLessons'

    export default {
        name: 'module',
        components: {
            MenuLessons
        },
        data: () => ({
        }),
        computed: {
            language () {
                return this.$store.getters['Language/language']
            },
            module () {
                return this.$store.getters['Module/module']
            },
            lessons () {
                return this.$store.getters['Module/module'].lessons
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
