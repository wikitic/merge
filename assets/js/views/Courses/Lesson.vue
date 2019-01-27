<template>
    <v-layout row>
        <MenuLessons :language="language" :module="module" :lessons="lessons"></MenuLessons>
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
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>