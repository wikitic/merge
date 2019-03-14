<template>
  <div class="exercise">
    <div class="image">
      <nuxt-link 
        :to="`/${exercise.alias}`"
        :title="exercise.title"
      >
        <img
          :src="exercise.image"
          :alt="exercise.title"
          class="img-fluid" 
        >
      </nuxt-link>
    </div>
    <div class="title">
      <nuxt-link 
        :to="`/${exercise.alias}`"
        :title="exercise.title"
      >
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
</template>

<script>
export default {
  name: 'Exercise',
  props: {
    exercise: {
      type: Object,
      default: () => {}
    }
  }
}
</script>

<style lang="scss">
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
    padding: 0 0 20px;
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
