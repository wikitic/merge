<template>
  <div class="mb-4">
    <div class="mb-1 title font-weight-bold blue--text">
      <router-link 
        :to="`/${exercise.alias}`"
      >
        {{ exercise.title }}
      </router-link>
    </div>
    <div class="mb-1 subheading font-weight-thin">
      {{ exercise.description }}
    </div>
    <div>
      <v-chip
        v-for="tag in exercise.tags"
        :key="tag"
        outline
      >
        {{ tag }}
      </v-chip>
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

<style lang="scss" scope>
</style>
