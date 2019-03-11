<template>
  <v-app>
    <v-toolbar
      app
      dark
      fixed
      flat
    >
      <Logo />
      <!--
      <v-text-field
        v-model="search"
        solo-inverted
        flat
        prepend-icon="search"
      />
      -->
    </v-toolbar>
    <v-content>
      <nuxt />
    </v-content>
  </v-app>
</template>

<script>
import Logo from '@/components/Layout/Logo'

export default {
  components: {
    Logo
  }
}
</script>
