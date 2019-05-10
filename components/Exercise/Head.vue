<template>
  <div
    :style="`background-image: linear-gradient(rgba(255,255,255,1), rgba(255,255,255,0.8)), url(${exercise.image});`"
    class="head"
  >
    <b-container>
      <h1>{{ exercise.title }}</h1>
    </b-container>
  </div>
</template>

<script>
export default {
  name: 'Head',
  props: {
    exercise: {
      type: Object,
      default: () => {}
    }
  }
}
</script>

<style lang="scss">
.head {
  margin-bottom: 15px;
  padding: 70px 0 100px;
  background-size: 100%;
  h1 {
    display: block;
    text-align: center;
    font-size: 40px;
    font-weight: 600;
  }
}
</style>
