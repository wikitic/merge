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
  asyncData() {
    return {
      title: 'Tutoriales',
      exercises: exercises
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
