<template>
  <footer class="footer">
    <b-container>
      <b-row>
        <b-col cols="12">
          Made with <span>&hearts;</span> by <a target="_blank" href="https://github.com/migueabellan">@migueabellan</a>
        </b-col>
      </b-row>
    </b-container>
  </footer>
</template>

<script>
export default {
  name: 'Footer'
}
</script>

<style lang="scss" scoped>
.footer {
  margin: 60px 0 0;
  padding: 30px 10px 10px;
  text-align: center;
  font-size: 14px;
  color: #888;
  span {
    color: #dc3545;
  }
  a {
    color: #888;
    &:hover {
      color: #333;
      text-decoration: none;
    }
  }
}
</style>
