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
          <div class="mb-5">
            <h1>Proyecto Educativo WikiTIC</h1>
            <p class="headline font-weight-light">
              WikiTIC es un proyecto educativo <strong>100% código abierto</strong> creado y gestionado por la <a href="https://www.programoergosum.com">Asociación Programo Ergo Sum</a>, para fomentar el uso de las <strong>TIC</strong> (<i>Tecnologías de la Información y la Comunicación</i>) en los centros educativos en los niveles de la <strong>ESO</strong> y <strong>Bachillerato</strong>.
            </p>
          </div>
          <div class="mb-5 text-xs-center">
            <h1>Patrocinadores</h1>
            <img width="250px" src="~/static/logo-programoergosum.png" title="Asociación Programo Ergo Sum">
          </div>
          <div class="mb-5 text-xs-center">
            <h1>Colaboradores</h1>
            <img width="250px" src="~/static/logo-aytomurcia.png" title="Ayuntamiento de Murcia">
            <img width="250px" src="~/static/logo-cprmurcia.png" title="Centro de Profesorado y Recursos">
          </div>
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
main {
  font-size: 18px;
  h1 {
    margin-bottom: 20px;
    font-size: 1.5em;
    font-weight: 600;
    line-height: 50px;
  }
  img {
    margin: 10px 20px 40px;
  }
}
</style>
