<template>    
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
</template>



<script>
    export default {
        name: 'Navigation',
        props: {
            drawer: {
                type: Boolean,
                default: true
            }
        },
        data: () => ({
            navigation: [
                { title: 'Blockly', icon: 'account_circle', link: '/cursos-online/blockly'},
                { title: 'Python', icon: 'account_circle', link: '/cursos-online/python'},
                { title: 'JavaScript', icon: 'account_circle', link: '/cursos-online/javascript'}
            ]
        })
    }
</script>