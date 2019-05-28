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
            <h2>Creado y gestionado por</h2>
            <img class="logo" src="~/static/logo-programoergosum.png" title="Asociación Programo Ergo Sum">
          </div>
          <div class="mb-5 text-xs-center">
            <h2>Colaboradores</h2>
            <img class="logo" src="~/static/logo-aytomurcia.png" title="Ayuntamiento de Murcia">
            <img class="logo" src="~/static/logo-cprmurcia.png" title="Centro de Profesorado y Recursos">
          </div>
          <!--
          <div class="mb-5 text-xs-center">
            <h2>Patrocinadores</h2>
            <v-chip>
              <v-avatar>
                <img src="https://avatars1.githubusercontent.com/u/12022187?s=460&v=4" />
              </v-avatar>
              Miguel Ángel Abellán
            </v-chip>
            <div class="mt-3">
              <a target="_blank" href="https://www.patreon.com/ProgramoErgoSum">
                Conviértete en patrocinador
              </a>
            </div>
          </div>
          -->
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
  h2 {
    margin-bottom: 20px;
    font-size: 1.4em;
    font-weight: 600;
    line-height: 50px;
  }
  strong {
    font-weight: 600;
  }
  .logo {
    display: inline-block;
    max-height: 50px;
    margin: 10px 20px 30px;
  }
}
</style>
