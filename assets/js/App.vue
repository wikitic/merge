<template>
    <v-app>
        
        <Navigation :drawer="drawer"></Navigation>

        <Toolbar v-on:clickToolbar="changeDrawer"></Toolbar>

        <v-content>
            <router-view></router-view>
        </v-content>

        <Footer></Footer>

    </v-app>
</template>



<script>
    import Navigation from './components/Layouts/Navigation'
    import Toolbar from './components/Layouts/Toolbar'
    import Footer from './components/Layouts/Footer'

    export default {
        name: 'app',
        components: {
            Navigation,
            Toolbar,
            Footer
        },
        data: () => ({
            drawer: true
        }),
        methods: {
            changeDrawer () {
                this.drawer = !this.drawer
            }
        }
    }
</script>