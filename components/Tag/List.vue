<template>
  <div class="tag-list position-sticky sticky-top">
    <h4>Tags</h4>
    <div class="tags">
      <TagItem
        v-for="tag in list"
        :key="tag"
        :tag="tag" 
      />
    </div>
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
      list: list.sort()
    }
  }
}
</script>

<style lang="scss">
.tag-list {
  margin-bottom: 30px;
  h4 {
    margin-bottom: 20px;
  }
}
</style>
