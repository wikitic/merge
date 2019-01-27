<template>
    <v-app>

        <v-navigation-drawer v-model="drawer" app clipped fixed>
            <v-list>
                <v-list-tile v-for="item in navigation" :key="item.title" :to="item.link">
                    <v-list-tile-action>
                        <v-icon v-text="item.icon"></v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title v-text="item.title"></v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </v-list>
            <v-divider></v-divider>
        </v-navigation-drawer>

        <v-toolbar class="v-toolbar" app fixed clipped-left>
            <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
            <v-toolbar-title>
                <img width="150px" src="../images/logo.svg" />
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <!--
            <v-menu offset-y origin="center center" :nudge-bottom="10" transition="scale-transition">
                <v-btn icon large flat slot="activator">
                    <v-avatar size="30px">
                        <img src="../images/icono.jpg" />
                    </v-avatar>
                </v-btn>
                <v-list class="pa-0">
                    <v-list-tile v-for="item in menu" :key="item.title" :to="item.href">
                        <v-list-tile-action v-if="item.icon">
                            <v-icon v-text="item.icon"></v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title v-text="item.title"></v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list>
            </v-menu>
            -->
        </v-toolbar>

        <v-content>
            <v-container fluid fill-height>
                <router-view></router-view>
            </v-container>
        </v-content>

        <v-footer>
            <v-layout justify-center>
                &copy;{{ date }} — Made with &hearts; by&nbsp;<strong>Asociación Programo Ergo Sum</strong>
            </v-layout>
        </v-footer>

    </v-app>
</template>

<script>
    //import Navigation from './components/Layouts/Navigation'
    //import Toolbar from './components/Layouts/Toolbar'
    //import Footer from './components/Layouts/Footer'

    export default {
        name: 'app',
        data: () => ({
            drawer: true,
            date: new Date().getFullYear(),
            menu: [
                { title: 'Blockly', icon: 'account_circle', link: '/cursos-online/blockly'},
                { title: 'Python', icon: 'account_circle', link: '/cursos-online/python'},
                { title: 'JavaScript', icon: 'account_circle', link: '/cursos-online/javascript'}
            ],
            navigation: [
                { title: 'Blockly', icon: 'account_circle', link: '/cursos-online/blockly'},
                { title: 'Python', icon: 'account_circle', link: '/cursos-online/python'},
                { title: 'JavaScript', icon: 'account_circle', link: '/cursos-online/javascript'}
            ]
        }),
        methods: {

        }
    }
</script>

<style lang="scss" scoped>

.v-toolbar {
    border-top: 5px solid #1caff6;
}

</style>
