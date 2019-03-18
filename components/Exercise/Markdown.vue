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
  /*,
  computed: {
    source: function() {
      return this.content
    }
  }
  */
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
  h4 {
    margin-top: 30px;
    margin-bottom: 20px;
    font-size: 1.1rem;
    font-weight: 500;
  }
  a {
    text-decoration: underline;
    color: #333;
    &:hover {
      color: #111;
    }
  }
  p {
    margin: 0 0 30px;
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
        position: relative;
        border: 3px solid #555;
        border-top: 30px solid #555;
        border-radius: 2px 2px 0 0;
        background: #1e2125;
        color: #fff;
      }
      &.language-sh::before {
        display: block;
        position: absolute;
        top: -18px;
        left: 14px;
        width: 7px;
        height: 7px;
        content: '';
        background-color: #777;
        border-radius: 50%;
        box-shadow: 0 0 0 3px #777, 24px 0 0 3px #777, 48px 0 0 3px #777;
      }
      &.language-python,
      &.language-arduino {
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
