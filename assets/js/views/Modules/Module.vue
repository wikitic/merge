<template>

    <v-card>
        <!--
        <v-img v-bind:src="module.image"></v-img>
        -->
        <v-card-title primary-title>
            <div>
                <h3>{{module.title}}</h3>
                <div>{{module.introtext}}</div>
            </div>
            {{module.level}}
        </v-card-title>
        <v-card-actions>
            <router-link :to="{ name: 'Lessons', params: { language: language.alias, module: module.alias }}">
                Entrar a la clase
            </router-link>
        </v-card-actions>
    </v-card>

</template>

<script>
    export default {
        name: 'Module',
        props: {
            language: {
                type: Object,
                default: null
            },
            module: {
                type: Object,
                default: null
            }
        }
    }
</script>