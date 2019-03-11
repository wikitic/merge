<template>
  <div class="logo font-weight-light">
    <router-link to="/">
      <span class="blue--text">W</span><span class="green--text">i</span><span class="orange--text">k</span><span class="red--text">i</span>
      <span class="tic font-weight-black">TIC</span>
    </router-link>
  </div>
</template>

<script>
export default {
  name: 'Logo'
}
</script>

<style lang="scss" scope>
.logo {
  font-size: 40px;
  a {
    text-decoration: none;
  }
  span {
    letter-spacing: 0;
  }
  .tic {
    font-size: 20px;
  }
}
</style>
