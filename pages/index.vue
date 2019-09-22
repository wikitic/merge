<template>
  <v-container fluid>
    <v-row>
      <v-col cols="12">
        <h1 class="pa-3 mb-6 primary text-center white--text display-1">
          Cursos de Formación del Profesorado de <b>Programo Ergo Sum</b>.
        </h1>
      </v-col>
      <v-col
        v-for="course in courses"
        :key="course.href"
        cols="12"
        xs="12"
        sm="12"
        md="6"
        lg="4"
      >
        <Item :course="course" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import Item from '@/components/Course/Item'

export default {
  components: {
    Item
  },
  asyncData({ store }) {
    const metas = {
      title: 'WikiTIC - Proyecto Educativo',
      description: 'Cursos de Formación del Profesorado aplicados a las TIC.',
      image: ''
    }
    return {
      metas,
      courses: store.state.courses.list
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
