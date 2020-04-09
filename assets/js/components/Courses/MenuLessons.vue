<template>

    <v-navigation-drawer>
        <v-list>
            <v-list-tile v-for="lesson in lessons" :key="lesson.alias" :to="getUrl(lesson)" >
                <v-list-tile-action>
                    <v-icon v-if="lesson.type">code</v-icon>
                    <v-icon v-else>local_library</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title v-text="lesson.title"></v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-list>
    </v-navigation-drawer>

</template>

<script>
    export default {
        name: 'MenuLessons',
        props: {
            lessons: {
                type: Array,
                default: null
            }
        },
        computed: {
            language () {
                return this.$store.getters['Language/language']
            },
            module () {
                return this.$store.getters['Module/module']
            },
        },
        methods: {
            getUrl (lesson) {
                return { name: 'Lesson', params: { language: this.language.alias, module: this.module.alias, lesson: lesson.alias }}
            }
        }
    }
</script>