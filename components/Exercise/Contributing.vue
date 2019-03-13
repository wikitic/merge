<template>
  <div class="contributing">
    <a
      :href="url"
      target="_blank"
    >
      <i class="fab fa-github" />
      Lee o edita página desde GitHub
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
  a {
    padding: 5px 15px;
    background: #2d2d2d;
    border-radius: 5px;
    color: #fff;
    &:hover {
      background: #333;
      color: #f0f0f0;
      text-decoration: none;
    }
  }
}
</style>
