<template>
    <v-toolbar color="primary" dark fixed app>
        <v-toolbar-side-icon @click.stop="$emit('clickToolbar')"></v-toolbar-side-icon>
        <v-toolbar-title>{{title}}</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-menu offset-y origin="center center" :nudge-bottom="10" transition="scale-transition">
            <v-btn icon large flat slot="activator">
                <v-avatar size="30px">
                    <img src="../../../images/icono.jpg" />
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
</template>



<script>
    export default {
        name: 'Toolbar',
        data: () => ({
            title: '',
            toolbar: [
                { title: 'Profile', icon: 'account_circle', href: '/profile' },
                { title: 'Logout', icon: 'fullscreen_exit', href: '/logout' }
            ]
        }),
        watch: {
            '$route' () {
                this.title = this.$route.name
            }
        }
    }
</script>