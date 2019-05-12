<template>
  <span 
    v-if="false"
  />
</template>

<script>
// import seo from '@/static/seo.js'

export default {
  name: 'Metas',
  props: {
    metas: {
      type: Object,
      default: () => ({
        title: 'Wiki TIC - Proyecto educativo',
        description:
          'Proyecto educativo de código abierto para fomentar el uso de las TIC en los niveles de ESO y Bachiller.',
        tags: ['código abierto', 'educación', 'raspberry pi', 'esp8266'],
        image: process.env.canonical + '/default.png'
      })
    }
  },
  head() {
    const title = this.metas.title
    const description = this.metas.description
    const keywords = this.metas.tags.toString()
    const image = this.metas.image
    const url = process.env.canonical + this.$route.path
    return {
      title: title,
      meta: [
        { rel: 'canonical', href: url },
        { name: 'description', content: description },
        { name: 'keywords', content: keywords },
        { property: 'og:title', content: title },
        { property: 'og:description', content: description },
        { property: 'og:image', content: image },
        { property: 'og:url', content: url },
        { name: 'twitter:card', content: 'summary_large_image' },
        { name: 'twitter:title', content: title },
        { name: 'twitter:description', content: description },
        { name: 'twitter:image', content: image }
      ]
    }
  }
}
</script>
