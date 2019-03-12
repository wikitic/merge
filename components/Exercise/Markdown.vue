<template>
  <vue-markdown
    :anchor-attributes="anchorAttrs"
    :source="content"
    class="markdown"
  />
</template>

<script>
import VueMarkdown from 'vue-markdown'

export default {
  name: 'Markdown',
  components: {
    VueMarkdown
  },
  props: {
    content: {
      type: String,
      default: ''
    }
  },
  data() {
    return {
      anchorAttrs: {
        target: '_blank',
        rel: 'noopener noreferrer nofollow'
      }
    }
  }
}
</script>

<style lang="scss" scope>
.markdown {
  margin-bottom: 50px;
  font-size: 20px;
  font-weight: normal;
  h1 {
    margin: 20px 0 40px;
    font-size: 38px;
  }
  h2,
  h3 {
    margin: 60px 0 20px;
  }
  img {
    max-width: 640px;
    width: 100%;
  }
  code {
    font-weight: normal;
    color: #333;
  }
  pre {
    code {
      display: block;
      margin: 0 0 20px;
      padding: 10px;
      background: #333;
      color: #fff;
    }
    code:before,
    code:after {
      content: none;
    }
  }
}
</style>
