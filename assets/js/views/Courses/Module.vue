<template>
    <v-layout row wrap justify-start>

        Redirect

    </v-layout>
</template>

<script>
    export default {
        name: 'module',
        data: () => ({
        }),
        created () {
            if (this.$route.params.lesson === undefined) {
                
                let language = this.$store.getters['Language/language']
                let module = this.$store.getters['Module/module']
                let lesson = this.$store.getters['Module/module'].lessons[0]

                //this.$router.push({name: 'Lesson', params: { language: language.alias, module: module.alias, lesson: lesson.alias }})
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
