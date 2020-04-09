<template>
    <v-container fluid fill-height>
        <v-layout align-center justify-center>
            <v-flex xs12 sm8 md4>
                <v-card class="elevation-12">
                    <v-toolbar dark color="primary">
                        <v-toolbar-title>Acceso</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <form @submit.prevent="submit">
                            <v-container grid-list-md>
                                <v-alert v-if="hasError" :value="true" type="error" outline>
                                    <b>{{ error.status }} {{ error.statusText }}</b>:
                                    <ul>
                                        <li>{{ error.data.error }}</li>
                                    </ul>
                                </v-alert>
                                <v-layout wrap>
                                    <v-flex xs12>
                                        <v-text-field v-model="user.username" label="Usuario" prepend-icon="person"></v-text-field>
                                    </v-flex>
                                    <v-flex xs12>
                                        <v-text-field v-model="user.password" label="Email" prepend-icon="lock" type="password"></v-text-field>
                                    </v-flex>
                                </v-layout>
                            </v-container>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn type="submit" :disabled="btnDisabled" color="primary">Ok</v-btn>
                            </v-card-actions>
                        </form>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>



<script>
    export default {
        name: 'login',
        data: () => ({
            error: null,
            user: {
                username: '',
                password: ''
            }
        }),
        created () {
            if (this.$store.getters['security/isAuthenticated']) {
                let redirect = this.$route.query.redirect || '/'
                this.$router.push({path: redirect})
            }
        },
        computed: {
            btnDisabled () {
                return this.user.username.length === 0 || this.user.password.length === 0
            },
            hasError () {
                return this.error !== null
            }
        },
        methods: {
            submit () {
                this.$store.dispatch('security/login', this.user)
                    .then(() => { this.$router.push({path: this.$route.query.redirect || '/'}) })
                    .catch(error => this.error = error.response )
            }
        }
    }
</script>