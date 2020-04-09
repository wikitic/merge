<template>
    <v-layout row wrap>
        <v-flex xs12 sm12 md12 lg3 xl2>
            <MenuLessons :lessons="lessons"></MenuLessons>
        </v-flex>
        <v-flex xs12 sm12 md12 lg9 xl10>
            {{language.title}}
            {{module.title}}
            
            <LessonView :lesson="lesson"></LessonView>
        </v-flex>
    </v-layout>
</template>

<script>
    import MenuLessons from '../../components/Courses/MenuLessons'
    
    import LessonView from '../../components/Courses/LessonView'

    export default {
        name: 'lesson',
        components: {
            MenuLessons,
            LessonView
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