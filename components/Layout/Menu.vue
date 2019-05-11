<template>
  <b-navbar toggleable="xl">
    <b-navbar-toggle target="nav-collapse" />
    <b-collapse id="nav-collapse" is-nav>
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
    </b-collapse>
  </b-navbar>
</template>

<script>
export default {
  name: 'Menu'
}
</script>

<style lang="scss" scoped>
.navbar {
  padding: 0;
  font-size: 1.1rem;
  font-weight: 500;
  background: #fff;
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
          background: #f0f0f0;
        }
      }
    }
  }
}
@media (max-width: 1300px) {
  .navbar {
    padding: 10px;
    .navbar-toggler {
      background: #f0f0f0;
    }
    .navbar-text,
    .icon-down {
      display: none;
    }
  }
}
</style>
