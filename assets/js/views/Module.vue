<template>
    <v-container grid-list-xl fluid>

        <v-card>
            <v-img v-bind:src="module.image"></v-img>

            <v-card-title primary-title>
                <div>
                    <h3 class="headline mb-0">{{module.title}}</h3>
                    <div>{{module.description}}</div>
                </div>
            </v-card-title>

            <v-card-actions>
                <v-btn flat color="orange">Share</v-btn>
                <v-btn flat color="orange">Explore</v-btn>
            </v-card-actions>
      </v-card>

    </v-container>
</template>

<script>
    export default {
        name: 'Module',
        props: {
            module: {
                type: Object,
                default: null
            }
        }
    }
</script>