<template>

    <v-card>
        <div v-html="lesson.description"> </div>
    </v-card>

</template>

<script>
    export default {
        name: 'LessonView',
        props: {
            lesson: {
                type: Object,
                default: null
            }
        }
    }
</script>