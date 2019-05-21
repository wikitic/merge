<template>
  <v-app>
    <v-navigation-drawer
      v-model="drawer"
      fixed
      app
    >
      <Logo />
      <v-divider />
      <Navigation />
    </v-navigation-drawer>
    <v-toolbar
      fixed
      dense
      app
    >
      <v-toolbar-side-icon
        @click="drawer = !drawer"
      />
      <router-link v-show="!drawer" to="/" class="logo">
        <span class="wiki">Wiki</span>
        <span class="tic">TIC</span>
      </router-link>
      <v-spacer />
      <!--
      <v-toolbar-items>
        <v-btn
          to="/mecenas"
          flat
        >
          Mecenas
          <v-icon right>
            fa-users
          </v-icon>
        </v-btn>
      </v-toolbar-items>
      -->
      <Forkme />
    </v-toolbar>
    <v-content>
      <router-view />
      <ToTop />
    </v-content>
    <v-footer
      app
      fixed
      absolute
      inset
      height="auto"
    >
      <Footer />
    </v-footer>
  </v-app>
</template>

<script>
import Logo from '@/components/Layout/Logo'
import Forkme from '@/components/Layout/Forkme'
import Navigation from '@/components/Layout/Navigation'
import ToTop from '@/components/Layout/ToTop'
import Footer from '@/components/Layout/Footer'

export default {
  components: {
    Logo,
    Forkme,
    Navigation,
    ToTop,
    Footer
  },
  data() {
    return {
      drawer: true
    }
  }
}
</script>

<style lang="scss" scoped>
.logo {
  text-decoration: none;
  .wiki {
    display: inline-block;
    padding: 0 15px;
    background: #2d2d2d;
    color: #fff;
    font-size: 30px;
    font-weight: 600;
    line-height: 50px;
  }
  .tic {
    color: #333;
    font-size: 22px;
    font-weight: 300;
  }
}
</style>
