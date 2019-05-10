<template>
  <b-container fluid>
    <b-row>
      <b-col
        v-for="exercise in exercises" 
        :key="exercise.alias"
        sm="12"
        md="6"
        lg="4"
      >
        <Exercise :exercise="exercise" />
      </b-col>
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
      title: params.tag,
      exercises: exercises.filter(e => {
        return e.tags.includes(params.tag.replace('+', ' '))
      })
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
