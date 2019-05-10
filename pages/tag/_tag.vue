<template>
  <b-container fluid>
    <b-row>
      <b-col md="12" order-lg="2" lg="2" xl="5">
        <TagList />
      </b-col>
      <b-col md="12" order-lg="1" lg="10" xl="7">
        <div
          v-for="exercise in exercises" 
          :key="exercise.alias"
        >
          <Exercise :exercise="exercise" />
        </div>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import exercises from '@/static/exercises.json'
import Exercise from '@/components/Exercise'
import TagList from '@/components/Tag/List'

export default {
  components: {
    Exercise,
    TagList
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
