<template>
  <header class="header">
    <b-container fluid>
      <div class="logo">
        <nuxt-link to="/">
          <span class="wiki">Wiki</span>
          <span class="tic">TIC</span>
        </nuxt-link>
      </div>
    </b-container>
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
    a {
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
    }
  }
}
</style>
