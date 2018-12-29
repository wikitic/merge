<template>
    <v-app>

        <v-navigation-drawer v-if="isAuthenticated" app>
            <navigation></navigation>
        </v-navigation-drawer>

        <v-toolbar v-if="isAuthenticated" app></v-toolbar>

        <v-content>
            <router-view></router-view>
        </v-content>

        <v-footer v-if="isAuthenticated" color="primary">
            <v-layout justify-center>
                <span class="white--text">&copy;{{ new Date().getFullYear() }} — <strong>Asociación Programo Ergo Sum</strong></span>
            </v-layout>
        </v-footer>

    </v-app>
    <!--
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <router-link class="navbar-brand" to="/home">App</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <router-link class="nav-item" tag="li" to="/home" active-class="active">
                        <a class="nav-link">Home</a>
                    </router-link>
                    <router-link class="nav-item" tag="li" to="/partners" active-class="active">
                        <a class="nav-link">Partners</a>
                    </router-link>
                    <li class="nav-item" v-if="isAuthenticated">
                        <a class="nav-link" href="/api/v1/logout">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>

        <router-view></router-view>
    </div>
    -->
</template>

<script>
    import axios from 'axios';
    import Navigation from './components/Navigation';

    export default {
        name: 'app',
        components: {
            Navigation,
        },
        created () {
            let isAuthenticated = JSON.parse(this.$parent.$el.attributes['data-is-authenticated'].value),
                roles = JSON.parse(this.$parent.$el.attributes['data-roles'].value);

            let payload = { isAuthenticated: isAuthenticated, roles: roles };
            this.$store.dispatch('security/onRefresh', payload);

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
        },
        computed: {
            isAuthenticated () {
                return this.$store.getters['security/isAuthenticated']
            },
        },
    }
</script>
