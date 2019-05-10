<template>
  <div id="body">
    <div id="header">
      <Header />
    </div>
    <div id="left-column">
      <Menu />
    </div>
    <div id="center-column">
      <nuxt class="content" />
      <Footer />
    </div>
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
  margin: 0;
  padding: 5px 0;
  border-top: 5px solid #2d2d2d;
  background: rgba(255, 255, 255, 0.99);
  box-shadow: 0px 3px 5px 0px rgba(0, 0, 0, 0.25);
}
#body {
  padding-top: 65px;
  #left-column {
    position: fixed;
    left: 0;
    top: 65px;
    bottom: 0;
    width: 215px;
    box-shadow: 0px 3px 5px 0px rgba(0, 0, 0, 0.25);
    background: linear-gradient(115deg, transparent 75%, #2f2f2f 75%) 0 0,
      linear-gradient(245deg, transparent 75%, #2f2f2f 75%) 0 0,
      linear-gradient(115deg, transparent 75%, #2f2f2f 75%) 7px -15px,
      linear-gradient(245deg, transparent 75%, #2f2f2f 75%) 7px -15px, #2d2d2d;
    background-size: 15px 30px;
  }
  #center-column {
    margin-left: 210px;
  }
}
@media (max-width: 1300px) {
  #header {
    position: relative;
  }
  #body {
    padding-top: 0;
    #left-column {
      position: relative;
      left: auto;
      top: auto;
      bottom: auto;
      width: auto;
    }
    #center-column {
      margin-left: auto;
    }
  }
}
</style>
