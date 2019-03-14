<template>
  <div>
    <Header />
    <nuxt 
      class="content"
    />
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
  padding: 30px 0;
}
</style>
