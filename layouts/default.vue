<template>
  <div>
    <header id="header">
      <Header />
      <Forkme />
    </header>
    <aside id="left-column">
      <Menu />
    </aside>
    <main id="center-column">
      <nuxt />
      <Footer v-show="!home" />
    </main>
  </div>
</template>

<script>
import Header from '@/components/Layout/Header'
import Forkme from '@/components/Layout/Forkme'
import Menu from '@/components/Layout/Menu'
import Footer from '@/components/Layout/Footer'

export default {
  components: {
    Header,
    Forkme,
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
  padding: 5px;
  border-top: 5px solid #2d2d2d;
  border-bottom: 1px solid #f0f0f0;
  background: rgba(255, 255, 255, 0.99);
  // box-shadow: 0px 3px 5px 0px rgba(0, 0, 0, 0.25);
}
#left-column {
  position: fixed;
  left: 0;
  top: 65px;
  bottom: 0;
  width: 215px;
  border-right: 1px solid #f0f0f0;
  // box-shadow: 0px 3px 5px 0px rgba(0, 0, 0, 0.25);
  background: #f0f0f0;
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
    display: none;
  }
  #center-column {
    margin-left: auto;
    margin-top: auto;
  }
}
</style>
