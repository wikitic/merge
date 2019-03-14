<template>
  <header class="header">
    <b-container>
      <b-row>
        <b-col cols="12" md="12">
          <div class="logo">
            <nuxt-link to="/">
              <span class="wiki">Wiki</span>
              <span class="tic">TIC</span>
            </nuxt-link>
            <span class="beta">(beta v1)</span>
          </div>
        </b-col>
      </b-row>
    </b-container>
  </header>
</template>

<script>
export default {
  name: 'Header'
}
</script>

<style lang="scss" scoped>
.header {
  margin: 0 0 30px;
  padding: 5px 0;
  box-shadow: 0 4px 12px 0 #f0f0f0;
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
    .beta {
      margin: 0 0 0 10px;
      padding: 1px 2px;
      font-size: 16px;
      color: #dc3545;
      line-height: 0;
    }
  }
}
</style>
