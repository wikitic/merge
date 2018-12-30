<template>
    <v-toolbar color="primary" fixed app :clipped-left="clipped">
        <v-spacer></v-spacer>
        <v-menu offset-y origin="center center" :nudge-bottom="10" transition="scale-transition">
            <v-btn icon large flat slot="activator">
                <v-avatar size="30px">
                    <img src="../../images/icono.jpg" />
                </v-avatar>
            </v-btn>
            <v-list class="pa-0">
                <v-list-tile v-for="(item, index) in items" :key="index" :to="item.href">
                    <v-list-tile-action v-if="item.icon">
                        <v-icon>{{ item.icon }}</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>{{ item.title }}</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </v-list>
        </v-menu>
    </v-toolbar>
</template>

<script>
    export default {
        name: 'toolbar',
        data () {
            return {
                items: [
                    {
                        icon: 'account_circle',
                        title: 'Profile',
                        href: '/profile',
                    },
                    {
                        icon: 'fullscreen_exit',
                        title: 'Logout',
                        href: '/logout',
                    }
                ]
            }
        }
    }
</script>
