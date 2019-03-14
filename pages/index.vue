<template>
  <b-container>
    <b-row>
      <b-col md="12" order-lg="2" lg="2" xl="4">
        <div class="tags">
          <h4>Tags</h4>
          <TagList />
        </div>
      </b-col>
      <b-col md="12" order-lg="1" lg="10" xl="8">
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

<style lang="scss" scoped>
</style>
