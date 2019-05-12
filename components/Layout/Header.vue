<template>
  <b-navbar toggleable="true">
    <b-navbar-toggle target="nav" />
    <b-navbar-brand to="/" class="logo">
      <span class="wiki">Wiki</span>
      <span class="tic">TIC</span>
      <span class="v">(v1.1.1)</span>
    </b-navbar-brand>
    <!--
    <b-navbar-brand to="#" rel="noopener noreferrer" class="login float-right">
      <span>Entra o Colabora</span>
      <i class="fa fa-user" />
    </b-navbar-brand>
    -->
    <b-collapse id="nav" is-nav>
      <Menu />
    </b-collapse>
  </b-navbar>
</template>

<script>
import Menu from '@/components/Layout/Menu'

export default {
  name: 'Header',
  components: {
    Menu
  }
}
</script>

<style lang="scss" scoped>
.navbar {
  display: block;
  margin: 0;
  padding: 0;
  .nav {
    padding: 5px 0 0;
  }
  .navbar-toggler {
    display: none;
  }
  .logo {
    padding: 0;
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
  /*
  .login {
    margin-right: 65px;
    padding: 0;
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
  */
}
@media (max-width: 1300px) {
  .navbar {
    .navbar-toggler {
      display: inline-block;
      margin-right: 10px;
      line-height: 0;
    }
  }
}
</style>
