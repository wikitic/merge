<template>
  <b-container>
    <b-row>
      <b-col cols="12" sm="12" md="1" lg="2" />
      <b-col cols="12" sm="12" md="10" lg="8">
        <div
          v-for="exercise in exercises" 
          :key="exercise.alias"
        >
          <Exercise :exercise="exercise" />
        </div>
      </b-col>
      <b-col cols="12" sm="12" md="1" lg="2" />
    </b-row>
  </b-container>
</template>

<script>
import exercises from '@/static/exercises.json'
import Exercise from '@/components/Exercise'

export default {
  components: {
    Exercise
  },
  asyncData({ params }) {
    return {
      exercises: exercises.filter(e => {
        return e.tags.includes(params.tag.replace('+', ' '))
      })
    }
  },
  head() {
    return {
      title: 'Wiki TIC'
    }
  }
}
</script>

<style lang="scss" scoped>
</style>
