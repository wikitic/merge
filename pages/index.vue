<template>
  <v-container fill-height>
    <v-layout justify-center align-center>
      <h1 class="font-weight-light">
        <span class="blue--text">W</span><span class="green--text">i</span><span class="orange--text">k</span><span class="red--text">i</span>
        <span class="tic font-weight-black">TIC</span>
      </h1>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  head() {
    return {
      title: 'Wiki TIC'
    }
  }
}
</script>

<style lang="scss" scope>
h1 {
  font-size: 150px;
  span {
    letter-spacing: 0;
  }
  .tic {
    font-size: 112px;
  }
}
</style>
