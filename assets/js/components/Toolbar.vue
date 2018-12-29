<template>
    <v-toolbar dark color="primary">
        <v-spacer></v-spacer>
        <v-btn icon large>
            {{ hasRole }}
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
            hasRole () {
                return this.$store.getters['security/isAuthenticated']
            },
        },
    }
</script>
