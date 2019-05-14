<template>
  <div class="contributing">
    <a
      class="btn"
      :href="url"
      target="_blank"
    >
      Edita página <i class="fab fa-github" /> GitHub
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
  margin-bottom: 15px;
  font-size: 16px;
  text-align: right;
  .btn {
    border: 1px solid #f0f0f0;
  }
  a {
    color: #666;
    &:hover {
      color: #333;
      text-decoration: none;
    }
  }
}
</style>
