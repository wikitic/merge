<template>
  <v-chip label>
    <nuxt-link
      class="tag"
      :to="`/tag/${encodeURIComponent(tag).replace(/%20/g,'+')}`"
    >
      {{ tag }}
    </nuxt-link>
  </v-chip>
</template>

<script>
export default {
  name: 'TagItem',
  props: {
    tag: {
      type: String,
      default: ''
    }
  }
}
</script>

<style lang="scss">
.tag {
  text-decoration: none;
}
</style>
