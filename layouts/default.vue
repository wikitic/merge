<template>
  <div>
    <Header />
    <div
      class="content"
    >
      <nuxt />
    </div>
    <Footer />
  </div>
</template>

<script>
import Header from '@/components/Layout/Header'
import Footer from '@/components/Layout/Footer'

export default {
  components: {
    Header,
    Footer
  }
}
</script>

<style lang="scss" scope>
.content {
  padding-top: 30px;
  padding-bottom: 30px;
}
</style>
