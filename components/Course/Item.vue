<template>
  <v-card :href="course.href" :disabled="course.href === ''" target="_blank">
    <v-img
      :src="course.image"
      lazy-src="lazy.png"
      :alt="course.title"
      class="white--text"
      height="250"
      gradient="to bottom, rgba(16,26,36,0), rgba(16,26,36,1)"
    >
      <!--
      <template v-slot:placeholder>
        <v-row class="fill-height ma-0" align="center" justify="center">
          <v-progress-circular indeterminate color="grey lighten-5" />
        </v-row>
      </template>
      -->
      <v-card-title class="align-end fill-height">
        {{ course.title }}
      </v-card-title>
    </v-img>
    <!--
    <v-card-title primary-title>
      <div class="subtitle-1">{{ course.description }}</div>
    </v-card-title>
    <v-divider class="mx-3 my-3"></v-divider>
    -->
    <v-card-text v-if="course.extra" class="mt-4">
      <v-alert v-show="course.href === ''" type="warning">
        Próximamente
      </v-alert>
      <p>
        <v-icon>mdi-calendar</v-icon>
        <strong>{{ course.extra.edition }}</strong> - {{ course.extra.date }}
      </p>
      <p>
        <v-icon>mdi-map</v-icon>
        {{ course.extra.address }}
      </p>
    </v-card-text>
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
