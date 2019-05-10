<template>
  <b-container fluid>
    <b-row>
      <b-col md="12" lg="3">
        <div
          class="position-sticky sticky-top"
        >
          <div
            v-html="menu"
            class="toc"
          />
        </div>
      </b-col>
      <b-col md="12" lg="9">
        <vue-markdown
          :toc="true"
          :toc-first-level="1"
          :toc-anchor-link="false"
          :source="content"
          v-on:toc-rendered="tocAllRight"
          class="markdown"
        />
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import VueMarkdown from 'vue-markdown'

export default {
  name: 'Markdown',
  components: {
    VueMarkdown
  },
  props: {
    exercise: {
      type: Object,
      default: () => {}
    },
    content: {
      type: String,
      default: ''
    }
  },
  data() {
    return {
      menu: ''
    }
  },
  methods: {
    tocAllRight: function(tocHtmlStr) {
      tocHtmlStr = tocHtmlStr.split('"#').join(`"/${this.exercise.alias}#`)
      this.menu = tocHtmlStr
    }
  }
}
</script>

<style lang="scss">
.toc {
  margin: 0 0 60px;
  padding: 10px 20px;
  border-right: 5px solid #f0f0f0;
  font-size: 16px;
  ul {
    margin: 0;
    padding: 0;
    list-style: none;
    li {
      &:before {
        content: '';
      }
      li {
        margin: 0 0 0 20px;
      }
      a {
        display: inline-block;
        margin: 5px 0;
        text-decoration: none;
        font-weight: 500;
      }
    }
  }
}
.markdown {
  h1 {
    margin-top: 60px;
    margin-bottom: 20px;
    font-size: 1.75em;
    font-weight: 600;
    line-height: 50px;
  }
  h2 {
    margin-top: 40px;
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
    font-size: 1.25rem;
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
    display: block;
    margin: 0 0 30px 30px;
    padding: 0;
    li {
      display: block;
      list-style: none;
      &:before {
        padding: 0 15px 0 0;
        content: '\2022';
      }
    }
  }
  blockquote {
    margin: 0 0 30px;
    padding: 10px 10px 10px 20px;
    border-left: 3px solid #999;
    background: #f0f0f0;
    font-style: italic;
    font-size: 1.1rem;
    line-height: 1.5rem;
    p {
      margin: 0;
      code {
        padding: 0 5px;
        line-height: 1rem;
      }
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
    font-family: 'Courier New', Courier, monospace;
    font-size: 0.75em;
    font-weight: normal;
    line-height: 1.25rem;
    white-space: pre-wrap;
    word-wrap: pre-wrap;
    code {
      display: block;
      position: relative;
      padding: 15px;
      line-height: 1.5rem;
      background: #e0e0e0;
      border-radius: 2px 2px 0 0;
      // language-sh
      &.language-sh {
        border: 3px solid #555;
        border-top: 30px solid #555;
        background: #1e2125;
        color: #fff;
      }
      &.language-sh::before {
        top: -18px;
        left: 15px;
        width: 7px;
        height: 7px;
        background: #777;
        border-radius: 50%;
        box-shadow: 0 0 0 3px #777, 24px 0 0 3px #777, 48px 0 0 3px #777;
      }
      // language-python
      &.language-python {
        border: 3px solid #daaa00;
        border-top: 30px solid #daaa00;
      }
      &.language-python::before {
        content: 'Python';
        color: #f0f0f0;
      }
      // language-arduino
      &.language-arduino {
        border: 3px solid #00979d;
        border-top: 30px solid #00979d;
      }
      &.language-arduino::before {
        content: 'Arduino';
        color: #f0f0f0;
      }

      &:before {
        display: block;
        position: absolute;
        top: -25px;
        left: 15px;
        content: '';
      }
      &:after {
        content: none;
      }
    }
  }
  table {
    margin: 0 0 30px;
    font-size: 1rem;
    line-height: 1.5rem;
    tr,
    th,
    td {
      padding: 10px;
      border: 1px solid #f0f0f0;
    }
    th {
      background: #f0f0f0;
    }
  }
  img {
    display: block;
    max-width: 100%;
    margin: 20px auto 30px;
  }
  hr {
    display: block;
    margin: 60px 0;
    border: 1px solid #f0f0f0;
  }
}
</style>
