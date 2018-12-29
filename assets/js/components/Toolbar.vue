<template>
    <v-toolbar dark color="primary">
        <v-spacer></v-spacer>
        <v-btn icon large>
            {{ username }}
            <v-avatar size="32px" tile>
                <img src="https://cdn.vuetifyjs.com/images/logos/logo.svg">
            </v-avatar>
        </v-btn>
    </v-toolbar>
</template>

<script>
    export default {
        name: 'toolbar',
        computed: {
            username () {
                return this.$store.getters['security/username']
            },
        },
    }
</script>
