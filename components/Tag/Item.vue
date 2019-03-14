<template>
  <span class="tag-item">
    <nuxt-link 
      :to="`/tag/${encodeURIComponent(tag).replace(/%20/g,'+')}`"
    >
      {{ tag }}
    </nuxt-link>
  </span>
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
.tag-item {
  display: inline-block;
  margin: 0 5px 5px 0;
  padding: 0 5px;
  border: 1px solid #f0f0f0;
  border-radius: 5px;
  font-size: 15px;
  line-height: auto;
  color: #888;
  a {
    color: #666;
    &:hover {
      color: #333;
      text-decoration: none;
    }
  }
}
</style>
