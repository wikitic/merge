<template>

    <v-card>
        <v-card-title primary-title>
            <div>
                <h3>{{lesson.title}}</h3>
            </div>
        </v-card-title>
        <v-card-actions>
            <router-link :to="{ name: 'Lesson', params: { language: language.alias, module: module.alias, lesson: lesson.alias }}">
                Entrar a la lección
            </router-link>
        </v-card-actions>
    </v-card>

</template>

<script>
    export default {
        name: 'Lesson',
        props: {
            language: {
                type: Object,
                default: null
            },
            module: {
                type: Object,
                default: null
            },
            lesson: {
                type: Object,
                default: null
            }
        }
    }
</script>