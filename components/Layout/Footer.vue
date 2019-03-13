<template>
  <footer class="footer">
    <b-container>
      <b-row>
        <b-col cols="12">
          made with <span>&hearts;</span> by <a target="_blank" href="https://github.com/migueabellan">@migueabellan</a>
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
  margin: 30px 0 0;
  padding: 10px;
  background: #2d2d2d;
  text-align: center;
  font-size: 14px;
  color: #fff;
  span {
    color: #dc3545;
  }
  a {
    color: #fff;
    &:hover {
      color: #fff;
      text-decoration: underline;
    }
  }
}
</style>
