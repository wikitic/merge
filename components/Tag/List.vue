<template>
  <div class="tags-list">
    <span
      v-for="tag in list"
      :key="tag"
      class="tag"
    >
      <TagItem :tag="tag" />
    </span>
  </div>
</template>

<script>
import exercises from '@/static/exercises.json'
import TagItem from '@/components/Tag/Item'

export default {
  name: 'TagList',
  components: {
    TagItem
  },
  data() {
    const list = []
    exercises.map(e => {
      e.tags.map(t => {
        if (list.indexOf(t) === -1) list.push(t)
      })
    })
    return {
      list: list
    }
  }
}
</script>

<style lang="scss">
</style>
