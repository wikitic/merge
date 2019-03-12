<template>
  <span 
    v-if="false"
  />
</template>

<script>
export default {
  name: 'Metas',
  props: {
    metas: {
      type: Object,
      default: () => ({})
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
