<template>
  <header class="header">
    <nuxt-link to="/" class="logo">
      <span class="wiki">Wiki</span>
      <span class="tic">TIC</span>
      <span class="v">(v1.1.1)</span>
    </nuxt-link>
    <!--
    <nuxt-link to="#" rel="noopener noreferrer" class="login float-right">
      <span>Entra o Colabora</span>
      <i class="fa fa-user" />
    </nuxt-link>
    -->
    <Forkme />
  </header>
</template>

<script>
import Forkme from '@/components/Layout/Forkme'

export default {
  name: 'Header',
  components: {
    Forkme
  }
}
</script>

<style lang="scss" scoped>
.header {
  .logo {
    text-decoration: none;
    .wiki {
      display: inline-block;
      padding: 0 15px;
      background: #2d2d2d;
      color: #fff;
      font-size: 30px;
      font-weight: 600;
      line-height: 50px;
    }
    .tic {
      color: #333;
      font-size: 22px;
      font-weight: 300;
    }
    .v {
      font-size: 12px;
    }
  }
  .login {
    margin-right: 65px;
    text-decoration: none;
    span {
      display: inline-block;
      width: 80px;
      padding-right: 5px;
      font-weight: 200;
      font-size: 14px;
      line-height: 20px;
      text-align: right;
      color: #666;
    }
    i {
      font-size: 48px;
      color: #d0d0d0;
    }
  }
}
</style>
