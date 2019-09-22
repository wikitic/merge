<template>
  <v-card :href="course.href" target="_blank">
    <v-img :src="course.image" :title="course.title" height="350">
      <template v-slot:placeholder>
        <v-layout fill-height align-center justify-center ma-0>
          <v-progress-circular indeterminate color="grey lighten-5" />
        </v-layout>
      </template>
    </v-img>
    <!--
    <v-card-title primary-title>
      <h3 class="mb-4 title">{{ course.title }}</h3>
      <div class="subtitle-1">{{ course.description }}</div>
    </v-card-title>
    <v-divider class="mx-3 my-3"></v-divider>
    <v-card-text v-if="course.extra">
      <p>
        <v-icon>mdi-calendar</v-icon>
        {{ course.extra.edition }} - {{ course.extra.date }}
      </p>
      <p>
        <v-icon>mdi-map</v-icon>
        {{ course.extra.address }}
      </p>
    </v-card-text>
    -->
  </v-card>
</template>

<script>
export default {
  name: 'Item',
  props: {
    course: {
      type: Object,
      required: true
    }
  }
}
</script>

<style lang="scss" scoped></style>
