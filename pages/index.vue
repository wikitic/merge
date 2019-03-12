<template>
  <b-container>
    <b-row>
      <b-col cols="12" sm="12" md="1" lg="2" />
      <b-col cols="12" sm="12" md="10" lg="8">
        <div
          v-for="exercise in exercises" 
          :key="exercise.alias"
          class="exercise"
        >
          <div class="image">
            <nuxt-link :to="`/${exercise.alias}`">
              <img
                :src="exercise.image"
                :alt="exercise.title"
                class="img-fluid" 
              >
            </nuxt-link>
          </div>
          <div class="title">
            <nuxt-link :to="`/${exercise.alias}`">
              {{ exercise.title }}
            </nuxt-link>
          </div>
          <div class="description">
            {{ exercise.description }}
          </div>
          <div class="tags">
            <span
              v-for="tag in exercise.tags"
              :key="tag"
              class="tag"
            >
              {{ tag }}
            </span>
          </div>
        </div>
      </b-col>
      <b-col cols="12" sm="12" md="1" lg="2" />
    </b-row>
  </b-container>
</template>

<script>
import exercises from '@/static/exercises.json'

export default {
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
.exercise {
  margin: 0 0 60px;
  padding: 0 0 60px;
  border-bottom: 1px solid #f0f0f0;
  .title {
    margin: 0 0 15px;
    font-size: 30px;
    font-weight: 600;
    line-height: 35px;
    a {
      &:hover {
        text-decoration: none;
      }
    }
  }
  .image {
    padding: 0 10% 20px;
  }
  .description {
    margin: 0 0 10px;
    font-size: 20px;
  }
  .tags {
    .tag {
      display: inline-block;
      margin: 0 10px 0 0;
      padding: 5px;
      background: #f0f0f0;
      border-radius: 5px;
    }
  }
}
</style>
