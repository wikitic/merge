<template>
  <v-hover>
    <v-card 
      class="card"
      :to="`/tutorial/${exercise.alias}`"
    >
      <v-img
        :src="exercise.image"
        aspect-ratio="1.75"
      />
      <v-card-title 
        primary-title
      >
        <h3
          class="title mb-3 font-weight-medium"
        >
          {{ exercise.title }}
        </h3>
        <div
          class="subheading font-weight-thin"
        >
          {{ exercise.description }}
        </div>
      </v-card-title>
    </v-card>
  </v-hover>
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
</style>
