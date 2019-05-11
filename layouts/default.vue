<template>
  <div>
    <Header id="header">
      <Header />
    </Header>
    <Sidebar id="left-column">
      <Menu />
    </Sidebar>
    <main id="center-column">
      <nuxt />
      <Footer v-show="!home" />
    </main>
  </div>
</template>

<script>
import Header from '@/components/Layout/Header'
import Menu from '@/components/Layout/Menu'
import Footer from '@/components/Layout/Footer'

export default {
  components: {
    Header,
    Menu,
    Footer
  },
  computed: {
    home: function() {
      return this.$nuxt.$route.name === 'index'
    }
  }
}
</script>

<style lang="scss" scope>
#header {
  position: fixed;
  z-index: 9999;
  top: 0;
  left: 0;
  right: 0;
  padding: 5px 0;
  border-top: 5px solid #2d2d2d;
  background: rgba(255, 255, 255, 0.99);
  box-shadow: 0px 3px 5px 0px rgba(0, 0, 0, 0.25);
}
#left-column {
  position: fixed;
  left: 0;
  top: 65px;
  bottom: 0;
  width: 215px;
  box-shadow: 0px 3px 5px 0px rgba(0, 0, 0, 0.25);
  background: #fff;
}
#center-column {
  position: relative;
  margin-left: 215px;
  margin-top: 65px;
  .sticky-top {
    top: 4.5em;
  }
}
@media (max-width: 1300px) {
  #header {
    position: relative;
  }
  #left-column {
    position: relative;
    left: auto;
    top: auto;
    bottom: auto;
    width: auto;
  }
  #center-column {
    margin-left: auto;
    margin-top: auto;
  }
}
</style>
