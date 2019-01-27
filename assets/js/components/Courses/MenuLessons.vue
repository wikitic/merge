<template>

    <v-list>
        <v-list-tile v-for="lesson in lessons" :key="lesson.alias" >
            <router-link :to="{ name: 'Lesson', params: { language: language.alias, module: module.alias, lesson: lesson.alias }}">
                <v-list-tile-title>{{ lesson.title }}</v-list-tile-title>
            </router-link>
        </v-list-tile>
    </v-list>

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