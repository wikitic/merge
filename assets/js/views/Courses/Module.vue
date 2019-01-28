<template>
    <v-layout row wrap>

        <v-flex xs12 sm12 md12 lg3 xl2>
            <MenuLessons :lessons="lessons"></MenuLessons>
        </v-flex>
        <v-flex xs12 sm12 md12 lg9 xl10>
            {{language.title}}
            {{module.title}}
            
            {{lesson}}
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
            },
            lesson () {
                let params = this.$route.params

                if (params.lesson !== undefined) {
                    return this.$store.getters['Module/module'].lessons[0]
                }

                //return this.$store.getters['Lesson/lesson']
            }
        }

/*
        created () {
            if (this.$route.params.lesson === undefined) {
                
                let language = this.$store.getters['Language/language']
                let module = this.$store.getters['Module/module']
                let lesson = this.$store.getters['Module/module'].lessons[0]

                console.log(language.alias)
                console.log(module.alias)
                console.log(lesson.alias)
                //this.$router.push({name: 'Lesson', params: { language: language.alias, module: module.alias, lesson: lesson.alias }})
            }
        }
*/
    }
</script>

<style lang="scss" scoped>

</style>
