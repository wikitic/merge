<template>
    <v-app>
        <v-content>
            <v-container fluid fill-height>
                <v-layout align-center justify-center>
                    <v-flex xs12 sm8 md4>
                        <v-card class="elevation-12">
                            <v-toolbar dark color="primary">
                                <v-toolbar-title>Acceso</v-toolbar-title>
                            </v-toolbar>
                            <v-card-text>
                                <form @submit.prevent="login">
                                    <v-text-field v-model="username" prepend-icon="person" name="username" label="Usuario" type="text"></v-text-field>
                                    <v-text-field v-model="password" prepend-icon="lock" name="password" label="Password" type="password"></v-text-field>
                                    <error-message v-if="hasError" :error="error"></error-message>
                                    <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-btn type="submit" :disabled="isDisabled" :loading="isLoading" color="primary">Ok</v-btn>
                                    </v-card-actions>
                                </form>
                            </v-card-text>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-content>
    </v-app>
</template>

<script>
    import ErrorMessage from '../components/ErrorMessage';

    export default {
        name: 'login',
        components: {
            ErrorMessage,
        },
        data () {
            return {
                username: '',
                password: ''
            };
        },
        created () {
            let redirect = this.$route.query.redirect;

            if (this.$store.getters['security/isAuthenticated']) {
                if (typeof redirect !== 'undefined') {
                    this.$router.push({path: redirect});
                } else {
                    this.$router.push({path: '/home'});
                }
            }
        },
        computed: {
            isDisabled () {
                return this.username.length === 0 || this.password.length === 0;
            },
            isLoading () {
                return this.$store.getters['security/isLoading'];
            },
            hasError () {
                return this.$store.getters['security/hasError'];
            },
            error () {
                return this.$store.getters['security/error'];
            },
        },
        methods: {
            login () {
                let payload = { username: this.$data.username, password: this.$data.password },
                    redirect = this.$route.query.redirect;

                this.$store.dispatch('security/login', payload)
                    .then(() => {
                        if (typeof redirect !== 'undefined') {
                            this.$router.push({path: redirect});
                        } else {
                            this.$router.push({path: '/partners'});
                        }
                    });
            },
        },
    }
</script>

<style lang="scss" scoped>

</style>