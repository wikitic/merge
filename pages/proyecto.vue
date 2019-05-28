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
              WikiTIC es un proyecto educativo de <strong>código abierto</strong> bajo licencia <b>Creative Commons Reconocimiento-CompartirIgual 4.0 Internacional</b> para fomentar el uso de las <b>TIC</b> (<i>Tecnologías de la Información y la Comunicación</i>) en los centros educativos en los niveles de la <b>ESO</b> y <b>Bachillerato</b>.
            </p>
          </div>
          <div class="mb-5 text-xs-center">
            <h1>Creado y gestionado por</h1>
            <img src="~/static/logo-programoergosum.png" title="Asociación Programo Ergo Sum">
          </div>
          <div class="mb-5 text-xs-center">
            <h1>Colaboradores</h1>
            <img src="~/static/logo-aytomurcia.png" title="Ayuntamiento de Murcia">
            <img src="~/static/logo-cprmurcia.png" title="Centro de Profesorado y Recursos">
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
  strong {
    font-weight: 600;
  }
  img {
    display: inline-block;
    max-height: 80px;
    margin: 10px 30px 40px;
  }
}
</style>
