<template>
  <b-navbar toggleable="xl">
    <b-navbar-toggle target="nav-collapse" />
    <b-collapse id="nav-collapse" is-nav>
      <b-nav vertical>
        <b-nav-text>
          Tutoriales
        </b-nav-text>
        <div class="icon-down" />
        <b-nav-item href="/tag/raspberry+pi">
          Raspberry Pi
        </b-nav-item>
        <b-nav-item href="/tag/microbit">
          Micro:bit
        </b-nav-item>
        <b-nav-item href="/tag/esp8266">
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
  .navbar-text {
    padding: 0.5rem 1rem;
    background: #fff;
    color: #2d2d2d;
  }
  .icon-down {
    width: 0px;
    margin-bottom: 10px;
    background: none;
    border-left: 45px solid transparent;
    border-right: 15px solid transparent;
    border-top: 20px solid #fff;
  }
  ul {
    width: 100%;
    li {
      margin-top: 1px;
      a {
        color: #fff;
        &.active,
        &:hover {
          background: #f0f0f0;
          color: #2d2d2d;
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
