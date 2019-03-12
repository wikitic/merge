<template>
  <v-layout
    row
    wrap
    class="mb-4"
  >
    <v-flex xs12 sm4 md3 class="pa-1">
      <v-img
        :src="exercise.image"
        aspect-ratio="1.78"
        class="grey lighten-2"
      >
        <template v-slot:placeholder>
          <v-layout
            fill-height
            align-center
            justify-center
            ma-0
          >
            <v-progress-circular indeterminate color="grey lighten-5" />
          </v-layout>
        </template>
      </v-img>
    </v-flex>
    <v-flex xs12 sm8 md9 class="pa-3">
      <div class="mb-3 title font-weight-bold blue--text">
        <nuxt-link 
          :to="`/${exercise.alias}`"
        >
          {{ exercise.title }}
        </nuxt-link>
      </div>
      <div class="mb-3 subheading font-weight-thin">
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
    </v-flex>
  </v-layout>
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
