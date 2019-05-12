<template>
  <b-nav vertical>
    <b-nav-text>
      Tutoriales
    </b-nav-text>
    <div class="icon-down" />
    <b-nav-item :to="{ path: '/tag/raspberry+pi' }" active-class="active">
      Raspberry Pi
    </b-nav-item>
    <b-nav-item :to="{ path: '/tag/microbit' }" active-class="active">
      Micro:bit
    </b-nav-item>
    <b-nav-item :to="{ path: '/tag/esp8266' }" active-class="active">
      ESP8266
    </b-nav-item>
  </b-nav>
</template>

<script>
export default {
  name: 'Menu'
}
</script>

<style lang="scss" scoped>
.navbar-text {
  padding: 0.5rem 1rem;
  background: #2d2d2d;
  color: #fff;
}
.icon-down {
  width: 0px;
  margin-bottom: 10px;
  background: none;
  border-left: 45px solid transparent;
  border-right: 15px solid transparent;
  border-top: 20px solid #2d2d2d;
}
ul {
  width: 100%;
  li {
    margin-top: 1px;
    a {
      color: #2d2d2d;
      &.active,
      &:hover {
        background: #fff;
      }
    }
  }
}
</style>
