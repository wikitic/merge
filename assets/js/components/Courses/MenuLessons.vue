<template>

    <v-navigation>
        <v-list>
            <v-list-tile v-for="lesson in lessons" :key="lesson.alias" :to="{ name: 'Lesson', params: { language: language.alias, module: module.alias, lesson: lesson.alias }}">
                <!--
                <v-list-tile-action>
                    <v-icon v-text="item.icon"></v-icon>
                </v-list-tile-action>
                -->
                <v-list-tile-action>
                    <v-icon v-if="lesson.type">code</v-icon>
                    <v-icon v-else>local_library</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title v-text="lesson.title"></v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-list>
    </v-navigation>

</template>

<script>
    export default {
        name: 'MenuLessons',
        props: {
            language: {
                type: Object,
                default: null
            },
            module: {
                type: Object,
                default: null
            },
            lessons: {
                type: Object,
                default: null
            }
        }
    }
</script>