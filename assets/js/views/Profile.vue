<template>
    <v-container grid-list-xl fluid>
        <v-layout row wrap>
            <v-flex lg6>
                <v-card class="mb-4">
                    <v-toolbar flat dense>
                        <v-toolbar-title class="subheading">Admin</v-toolbar-title>
                    </v-toolbar>
                    <v-divider></v-divider>
                    <v-card-text>
                        <form @submit.prevent="patchAdmins">
                            <v-text-field v-model="username" prepend-icon="person" name="username" label="Usuario" type="text"></v-text-field>
                            <v-text-field v-model="password" prepend-icon="lock" name="password" label="Password" type="password"></v-text-field>
                            <error-message v-if="hasError" :error="error"></error-message>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn type="submit" :disabled="isDisabled" color="primary">Ok</v-btn>
                            </v-card-actions>
                        </form>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import ErrorMessage from '../components/ErrorMessage';

    export default {
        name: 'profile',
        components: {
            ErrorMessage,
        },
        data () {
            return {
                username: '',
                password: ''
            };
        },
        computed: {
            isDisabled () {
                return this.username.length === 0 || this.password.length === 0;
            },
            hasError () {
                return this.$store.getters['admin/hasError'];
            },
            error () {
                return this.$store.getters['admin/error'];
            },
        },
        methods: {
            patchAdmins () {
                let admin = { 
                    id: 1,
                    username: this.$data.username, 
                    password: this.$data.password 
                };

                /*
                this.$store.dispatch('security/patchAdmins', admin)
                    .then(() => {
                        //this.$router.push({path: redirect});
                    }); 
                */
                
            }
        }
    }
</script>