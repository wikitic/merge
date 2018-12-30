<template>
    <v-app>

        <navigation v-if="isAuthenticated"></navigation>

        <toolbar v-if="isAuthenticated"></toolbar>

        <v-content>
            <router-view></router-view>
        </v-content>

        <v-footer v-if="isAuthenticated">
            <v-layout justify-center>
                &copy;{{ new Date().getFullYear() }} — <strong>Asociación Programo Ergo Sum</strong>
            </v-layout>
        </v-footer>

    </v-app>
</template>

<script>
    import axios from 'axios';
    import Navigation from './components/Navigation';
    import Toolbar from './components/Toolbar';

    export default {
        name: 'app',
        components: {
            Navigation,
            Toolbar,
        },
        created () {
            let isAuthenticated = JSON.parse(this.$parent.$el.attributes['data-is-authenticated'].value),
                username = JSON.parse(this.$parent.$el.attributes['data-username'].value),
                roles = JSON.parse(this.$parent.$el.attributes['data-roles'].value);

            let payload = { isAuthenticated: isAuthenticated, username: username, roles: roles };
            this.$store.dispatch('security/onRefresh', payload);

            /*
            axios.interceptors.response.use(undefined, (err) => {
                return new Promise(() => {
                    if (err.response.status === 403) {
                        this.$router.push({path: '/login'})
                    } else if (err.response.status === 500) {
                        document.open();
                        document.write(err.response.data);
                        document.close();
                    }
                    throw err;
                });
            });
            */
        },
        computed: {
            isAuthenticated () {
                return this.$store.getters['security/isAuthenticated']
            },
        },
    }
</script>
