<template>
    <v-layout row wrap>
        <v-flex xs12 sm12 md12 lg3 xl2>
            <MenuLessons :language="language" :module="module" :lessons="lessons"></MenuLessons>
        </v-flex>
        <v-flex xs12 sm12 md12 lg9 xl10>
            {{lesson | json}}
        </v-flex>
    </v-layout>
</template>

<script>
    //import Lesson from '../../components/Courses/Lesson'
    import MenuLessons from '../../components/Courses/MenuLessons'

    export default {
        name: 'lesson',
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
            },
            lesson () {
                return this.$store.getters['Lesson/lesson']
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>