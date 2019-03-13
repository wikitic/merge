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

<style lang="scss">
.markdown {
  h1 {
    margin-bottom: 20px;
    font-size: 1.75em;
    font-weight: 600;
    line-height: 50px;
  }
  h2 {
    margin-top: 60px;
    margin-bottom: 20px;
    font-size: 1.5rem;
    font-weight: 700;
  }
  h3 {
    margin-top: 30px;
    margin-bottom: 20px;
    font-size: 1.25rem;
    font-weight: 600;
  }
  p {
    margin: 0 0 30px;
    a {
      color: #000;
    }
    strong {
      font-weight: 600;
    }
    em {
      font-style: italic;
    }
  }
  ul {
    margin: 0 0 60px 20px;
    padding: 0;
    li {
      margin: 0 0 10px;
      list-style: none;
      &:before {
        padding: 0 15px 0 0;
        content: '\2022';
      }
    }
  }
  blockquote {
    margin: 0 0 30px;
    padding: 10px 10px 10px 30px;
    border-left: 3px solid #2d2d2d;
    background: #f0f0f0;
    font-style: italic;
    p {
      margin: 0;
    }
  }
  code {
    padding: 2px 7px;
    background: #f0f0f0;
    border-radius: 5px;
    font-family: 'Courier New', Courier, monospace;
    font-weight: 200;
    color: #333;
  }
  pre {
    display: block;
    margin: 0 0 30px;
    background: #f0f0f0;
    font-family: 'Courier New', Courier, monospace;
    font-size: 0.75em;
    font-weight: normal;
    line-height: 1.25rem;
    white-space: pre-wrap;
    word-wrap: pre-wrap;
    code {
      display: block;
      padding: 15px;
      &.language-sh {
        border: 5px solid #555;
        border-top: 30px solid #555;
        border-radius: 2px;
        background: #2d2d2d;
        color: #fff;
      }
      &.language-python {
        border: 2px solid #555;
        border-radius: 2px;
        background: #f0f0f0;
        line-height: 1.75rem;
      }
      &:before,
      &:after {
        content: none;
      }
    }
  }
  img {
    display: block;
    max-width: 100%;
    margin: 20px auto 30px;
  }
}
</style>
