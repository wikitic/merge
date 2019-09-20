<template>
  <v-app>
    <v-content>
      <nuxt class="nuxt-content" />
    </v-content>
  </v-app>
</template>

<script>
export default {
  components: {},
  head() {
    const canonical = `${process.env.www}${this.$route.path}`
    return {
      link: [
        { rel: 'canonical', href: canonical }
        // { hid: 'description', name: 'description', content: description }
      ],
      meta: [
        { property: 'og:locale', content: 'es' },
        { property: 'og:site_name', content: 'Asociación Programo Ergo Sum' },
        { property: 'og:type', content: 'article' }, // website
        { property: 'og:url', content: canonical },
        // { hid: 'o:t', property: 'og:title', content: title }
        // { hid: 'o:d', property: 'og:description', content: description }
        // { hid: 'o:i', property: 'og:image', content: image }

        { name: 'twitter:site', content: '@ProgramoErgoSum' },
        { name: 'twitter:creator', content: '@ProgramoErgoSum' },
        { name: 'twitter:card', content: 'summary_large_image' }
        // { hid: 't:t', name: 'twitter:title', content: title }
        // { hid: 't:d', name: 'twitter:description', content: description }
        // { hid: 't:i', name: 'twitter:image', content: image }
      ]
    }
  }
}
</script>

<style lang="scss" scoped></style>
