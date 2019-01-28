<template>
    <v-layout row wrap>

        <v-flex xs12 sm12 md12 lg3 xl2>
            <MenuLessons :lessons="lessons"></MenuLessons>
        </v-flex>
        <v-flex xs12 sm12 md12 lg9 xl10>
            Estás apunto de empezar...
            Haz clic en el botón para ir a la primera lección
        </v-flex>

    </v-layout>
</template>

<script>
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
        /*
        created () {
            if (this.$route.params.lesson === undefined) {
                
                // Redirect first lesson
                let language = this.$store.getters['Language/language']
                let module = this.$store.getters['Module/module']
                let lesson = this.$store.getters['Module/module'].lessons[0]
                this.$router.push({
                    name: 'Lesson', 
                    params: {
                        language: language.alias, 
                        module: module.alias, 
                        lesson: lesson.alias 
                    }
                })
            }
        }
        */
    }
</script>

<style lang="scss" scoped>

</style>
