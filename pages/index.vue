<template>
  <v-container>
    <!--
    <v-row>
      <v-col cols="12">
        <h1>Cursos</h1>
        <v-list class="mb-12">
          <template v-for="course in courses">
            <v-list-item :key="course.href" :href="course.href" target="_blank">
              <v-list-item-content>
                <v-list-item-title>
                  {{ course.title }}
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </template>
        </v-list>
      </v-col>
    </v-row>
    -->
  </v-container>
</template>

<script>
export default {
  components: {},
  data: () => ({
    courses: [
      {
        title: 'Programación en Python con Raspberry Pi',
        href:
          'https://programoergosum.github.io/programacion-en-python-con-raspberry-pi/#/'
      }
    ]
  }),
  asyncData({ store }) {
    const metas = {
      title: 'WikiTIC - Proyecto Educativo',
      description:
        'Proyecto educativo de código abierto para fomentar el uso de las TIC en los niveles de ESO y Bachiller.',
      image: ''
    }
    return {
      metas
    }
  },
  head() {
    const title = this.metas.title
    const description = this.metas.description
    const image = `${process.env.cdn}${this.metas.image}`

    return {
      title,
      meta: [
        // Global
        { hid: 'description', name: 'description', content: description },
        // Facebook
        { hid: 'o:t', property: 'og:title', content: title },
        { hid: 'o:d', property: 'og:description', content: description },
        { hid: 'o:i', property: 'og:image', content: image },
        // Twitter
        { hid: 't:t', name: 'twitter:title', content: title },
        { hid: 't:d', name: 'twitter:description', content: description },
        { hid: 't:i', name: 'twitter:image', content: image }
      ]
    }
  }
}
</script>

<style lang="scss" scoped></style>
