<template>
  <v-app>
    <v-navigation-drawer
      v-model="drawer"
      clipped
      fixed
      app
    >
      <Navigation />
    </v-navigation-drawer>
    <v-toolbar
      clipped-left
      fixed
      app
    >
      <v-toolbar-side-icon
        class="hidden-md-and-up-"
        @click="drawer = !drawer"
      />
      <router-link to="/" class="logo">
        <span class="wiki">Wiki</span>
        <span class="tic">TIC</span>
      </router-link>
      <v-spacer />
      <!--
      <router-link to="/login" class="login">
        <span>Entra o Colabora</span>
        <v-icon>account_circle</v-icon>
      </router-link>
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
import Forkme from '@/components/Layout/Forkme'
import Navigation from '@/components/Layout/Navigation'
import ToTop from '@/components/Layout/ToTop'
import Footer from '@/components/Layout/Footer'

export default {
  components: {
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
/*
.login {
  margin-right: 65px;
  padding: 0;
  text-decoration: none;
  span {
    display: inline-block;
    width: 80px;
    padding-right: 5px;
    font-size: 14px;
    line-height: 15px;
    text-align: right;
    color: #666;
  }
  i {
    font-size: 48px;
    color: #d0d0d0;
  }
}
*/
</style>
