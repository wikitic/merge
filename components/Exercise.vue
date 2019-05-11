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
      >
        <TagItem :tag="tag" />
      </span>
    </div>
    <nuxt-link 
      :to="`/${exercise.alias}`"
      :title="exercise.title"
      class="readmore"
    >
      acceder al tutorial
    </nuxt-link>
  </div>
</template>

<script>
import TagItem from '@/components/Tag/Item'

export default {
  name: 'Exercise',
  components: {
    TagItem
  },
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
  margin-bottom: 10px;
  padding: 10px;
  background: #fff;
  border: 1px solid #f0f0f0;
  &:hover {
    box-shadow: 0px 0px 10px 5px #ccc;
  }
  .image {
    padding: 0 0 20px;
  }
  .title {
    min-height: 55px;
    margin-bottom: 10px;
    font-size: 18px;
    font-weight: 600;
    line-height: 1.5;
    a {
      &:hover {
        text-decoration: none;
      }
    }
  }
  .description {
    min-height: 55px;
    margin-bottom: 10px;
    font-size: 16px;
    color: #686868;
    line-height: 1.5;
  }
  .tags {
    margin-bottom: 10px;
  }
  .readmore {
    display: block;
    padding: 5px;
    background: #2d2d2d;
    color: #f0f0f0;
    text-align: center;
    text-decoration: none;
    font-size: 14px;
  }
}
</style>
