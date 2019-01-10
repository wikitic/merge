<template>    
    <v-navigation-drawer v-model="drawer" app fixed>
        <v-toolbar flat>
            <v-avatar size="120px">
                <img src="../../../images/logo.svg" />
            </v-avatar>
        </v-toolbar>
        <v-divider></v-divider>
        <v-list>
            <v-list-tile :to="'/'">
                <v-list-tile-action>
                    <v-icon>home</v-icon>
                </v-list-tile-action>
                <v-list-tile-title>Página principal</v-list-tile-title>
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
                { title: 'Socios', icon: 'account_circle', link: '/partners',
                    items: [
                        { title: 'Socios', link: '/partners' }
                    ]
                }
            ]
        })
    }
</script>