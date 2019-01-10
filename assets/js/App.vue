<template>
    <v-app>
        
        <Navigation v-if="isAuthenticated" :drawer="drawer"></Navigation>

        <Toolbar v-if="isAuthenticated" v-on:clickToolbar="changeDrawer"></Toolbar>

        <v-content>
            <Breadcrumb v-if="isAuthenticated"></Breadcrumb>

            <router-view></router-view>
        </v-content>

        <Footer v-if="isAuthenticated"></Footer>

    </v-app>
</template>



<script>
    import Navigation from './components/Layouts/Navigation'
    import Toolbar from './components/Layouts/Toolbar'
    import Breadcrumb from './components/Layouts/Breadcrumb'
    import Footer from './components/Layouts/Footer'

    export default {
        name: 'app',
        components: {
            Navigation,
            Toolbar,
            Breadcrumb,
            Footer
        },
        data: () => ({
            drawer: true
        }),
        created () {
            let payload = { 
                isAuthenticated: JSON.parse(this.$parent.$el.attributes['data-is-authenticated'].value), 
                user: JSON.parse(this.$parent.$el.attributes['data-user'].value) 
            }
            this.$store.dispatch('security/onRefresh', payload)
        },
        computed: {
            isAuthenticated () {
                return this.$store.getters['security/isAuthenticated']
            }
        },
        methods: {
            changeDrawer () {
                this.drawer = !this.drawer
            }
        }
    }
</script>