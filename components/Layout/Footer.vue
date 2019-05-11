<template>
  <footer class="footer">
    <p>Esta obra está bajo una licencia de <a target="_blank" rel="noopener noreferrer" href="https://creativecommons.org/licenses/by-sa/4.0/deed.es_ES">Creative Commons Reconocimiento-CompartirIgual 4.0 Internacional</a>.</p>
    <p>{{ new Date().getFullYear() }} - <a target="_blank" rel="noopener noreferrer" href="https://www.programoergosum.com">Asociación Programo Ergo Sum</a></p>
  </footer>
</template>

<script>
export default {
  name: 'Footer'
}
</script>

<style lang="scss" scoped>
.footer {
  margin: 60px 0 0;
  padding: 20px 10px;
  background: #2d2d2d;
  text-align: center;
  font-size: 12px;
  line-height: 1.6;
  color: #f0f0f0;
  p {
    margin: 0;
    padding: 0;
    a {
      color: #888;
      &:hover {
        color: #fff;
        text-decoration: none;
      }
    }
  }
}
</style>
