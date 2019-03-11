<template>
  <v-container>
    <v-layout
      row 
      wrap
    >
      <v-flex 
        v-for="exercise in exercises" 
        :key="exercise.alias"
        xs12
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
  data() {
    return {
      exercises: exercises
    }
  },
  head() {
    return {
      title: 'Wiki TIC'
    }
  }
}
</script>

<style lang="scss" scope>
</style>
