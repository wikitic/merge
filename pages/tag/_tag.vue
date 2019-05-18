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
        v-for="exercise in exercises"
        :key="exercise.alias"
        xs12
        sm6
        md4
        lg3
      >
        <Exercise
          :exercise="exercise"
        />
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import exercises from '@/static/exercises.json'
import Exercise from '@/components/Exercise'

export default {
  components: {
    Exercise
  },
  asyncData({ params }) {
    const title = params.tag !== undefined ? params.tag : 'Tutoriales'
    const all =
      params.tag !== undefined
        ? exercises.filter(e => {
            return e.tags.includes(title.replace('+', ' '))
          })
        : exercises
    return {
      title: title,
      exercises: all
    }
  },
  head() {
    return {
      title: `Wiki TIC - ${this.title}`
    }
  }
}
</script>

<style lang="scss" scoped>
</style>
