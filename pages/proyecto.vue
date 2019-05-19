<template>
  <v-container
    fluid
    grid-list-md
  >
    <v-layout
      row
      wrap
    >
      <v-flex 
        xs12
      >
        <Metas />
        <main>
          <h1 class="mb-3 display-1 font-weight-bold">
            ¿Qué es WikiTIC?
          </h1>
          <p class="headline font-weight-light">
            WikiTIC es un proyecto educativo de código abierto que surge de la necesidad de fomentar el uso de las TIC (<i>Tecnologías de la Información y la Comunicación</i>) en los centros educativos, principalmente en los niveles de la ESO y Bachillerato.
          </p>
          <h1 class="mt-5 mb-3 display-1 font-weight-bold">
            ¿Quién está detrás de WikiTIC?
          </h1>
          <p class="headline font-weight-light">
            WikiTIC es otro proyecto educativo creado y gestionado por la <a href="https://www.programoergosum.com">Asociación Programo Ergo Sum</a>.
          </p>
          <h1 class="mt-5 mb-3 display-1 font-weight-bold">
            ¿Qué licencia tiene WikiTIC?
          </h1>
          <p class="headline font-weight-light">
            Todo el contenido incluída la propia página web están alojados en repositorios públicos de GitHub. La página web tiene una licencia MIT y todo el contenido CC-BY-SA 4.0.
          </p>
        </main>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import Metas from '@/components/Layout/Metas'

export default {
  components: {
    Metas
  }
}
</script>

<style lang="scss" scoped>
</style>
