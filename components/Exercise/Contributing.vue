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
  margin-top: 30px;
  font-size: 16px;
  text-align: center;
  a {
    color: #666;
    &:hover {
      color: #333;
      text-decoration: none;
    }
  }
}
</style>
