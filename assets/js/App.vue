<template>
    <v-app>
        
        <v-navigation-drawer v-if="isAuthenticated" v-model="drawer" app fixed>
            <v-toolbar flat>
                <v-avatar size="120px">
                    <img src="../images/logo.svg" />
                </v-avatar>
            </v-toolbar>
            <v-divider></v-divider>
            <v-list>
                <v-list-tile :to="'/dashboard'">
                    <v-list-tile-action>
                        <v-icon>home</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-title>Dashboard</v-list-tile-title>
                </v-list-tile>
                <v-list-group v-for="item in navigation" :key="item.title" :to="item.link">
                    <v-list-tile slot="activator">
                        <v-list-tile-action>
                            <v-icon v-text="item.icon"></v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title v-text="item.title"></v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile v-for="subitem in item.items" :key="subitem.title" :to="subitem.link">
                        <v-list-tile-action>
                            <v-icon></v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title v-text="subitem.title"></v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list-group>
            </v-list>
        </v-navigation-drawer>

        <v-toolbar color="primary" v-if="isAuthenticated" dark fixed app>
            <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
            <v-toolbar-title></v-toolbar-title>
            <v-spacer></v-spacer>
            <v-menu offset-y origin="center center" :nudge-bottom="10" transition="scale-transition">
                <v-btn icon large flat slot="activator">
                    <v-avatar size="30px">
                        <img src="../images/icono.jpg" />
                    </v-avatar>
                </v-btn>
                <v-list class="pa-0">
                    <v-list-tile v-for="item in toolbar" :key="item.title" :to="item.href">
                        <v-list-tile-action v-if="item.icon">
                            <v-icon v-text="item.icon"></v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title v-text="item.title"></v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list>
            </v-menu>
        </v-toolbar>

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

    export default {
        name: 'app',
        data () {
            return {
                drawer: null,
                navigation: [
                    { title: 'Socios', icon: 'account_circle', link: '/partners',
                        items: [
                            { title: 'Socios', link: '/partners' },
                            { title: 'Suscripciones', link: '/subscriptions' }
                        ]
                    }
                ],
                toolbar: [
                    { title: 'Profile', icon: 'account_circle', href: '/profile' },
                    { title: 'Logout', icon: 'fullscreen_exit', href: '/logout' }
                ]
            }
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
