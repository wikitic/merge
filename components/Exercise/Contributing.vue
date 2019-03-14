<template>
  <div class="contributing">
    <a
      :href="url"
      target="_blank"
    >
      Edita página desde <i class="fab fa-github" /> GitHub
    </a>
  </div>
</template>

<script>
export default {
  name: 'Contributing',
  props: {
    url: {
      type: String,
      default: ''
    }
  }
}
</script>

<style lang="scss">
.contributing {
  margin: 30px 0 0;
  padding: 30px 0 0;
  border-top: 1px solid #f0f0f0;
  text-align: right;
  font-size: 16px;
  a {
    color: #666;
    &:hover {
      color: #333;
      text-decoration: none;
    }
  }
}
</style>
