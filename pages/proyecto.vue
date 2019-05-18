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
          <h1 class="display-1 mb-5">
            Proyecto Educativo WikiTIC
          </h1>
          <p class="title font-weight-light">
            El proyecto WikiTIC es un proyecto educativo de código abierto creado por la Asociación Programo Ergo Sum.
          </p>
          <p class="title font-weight-light">
            Surge de la necesidad de fomentar el uso de las TIC (<i>Tecnologías de la Información y la Comunicación</i>) en los centros educativos, principalmente en los niveles de la ESO y Bachillerato.
          </p>
          <br>
          <br>
          <div class="licencia">
            <h3 class="display-1 mb-3">
              Licencia
            </h3>
            <v-list>
              <v-list-tile>
                <v-list-tile-title class="title font-weight-medium">
                  Esta obra está bajo una licencia de Creative Commons Reconocimiento-CompartirIgual 4.0 Internacional.
                </v-list-tile-title>
              </v-list-tile>
              <v-list-tile class="mt-3">
                <v-list-tile-title class="title font-weight-medium">
                  Usted es libre:
                </v-list-tile-title>
              </v-list-tile>
              <v-list-tile>
                <v-list-tile-action>
                  <v-icon>share</v-icon>
                </v-list-tile-action>
                <v-list-tile-content class="font-weight-light">
                  Compartir y redistribuir el material en cualquier medio o formato.
                </v-list-tile-content>
              </v-list-tile>
              <v-list-tile>
                <v-list-tile-action>
                  <v-icon>code</v-icon>
                </v-list-tile-action>
                <v-list-tile-content class="font-weight-light">
                  Remezclar, transformar y crear a partir del material para cualquier finalidad, incluso comercial.
                </v-list-tile-content>
              </v-list-tile>
              <v-list-tile class="mt-3">
                <v-list-tile-title class="title font-weight-medium">
                  Bajo las siguientes condiciones:
                </v-list-tile-title>
              </v-list-tile>
              <v-list-tile>
                <v-list-tile-action>
                  <v-icon>accessibility</v-icon>
                </v-list-tile-action>
                <v-list-tile-content class="font-weight-light">
                  Debe reconocer adecuadamente la autoría, proporcionar un enlace a la licencia e indicar si se han realizado cambios.
                </v-list-tile-content>
              </v-list-tile>
              <v-list-tile>
                <v-list-tile-action>
                  <v-icon>loop</v-icon>
                </v-list-tile-action>
                <v-list-tile-content class="font-weight-light">
                  Si remezcla, transforma o crea a partir del material, deberá difundir sus contribuciones bajo la misma licencia que el original.
                </v-list-tile-content>
              </v-list-tile>
            </v-list>
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
</style>
