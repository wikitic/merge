<template>
  <v-container>
    <v-layout
      row 
      wrap
    >
      <v-flex 
        xs12
      >
        <Metas
          :metas="metas"
        />
        <Markdown
          :content="exercise" 
        />
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import axios from 'axios'
import exercises from '@/static/exercises.json'
import Metas from '@/components/Layout/Metas'
import Markdown from '@/components/Exercise/Markdown'

export default {
  components: {
    Metas,
    Markdown
  },
  async asyncData({ params }) {
    const API_EX = 'https://raw.githubusercontent.com/wikitic/'
    const repo = `${API_EX}${params.alias}/master/es/`
    const raw = `${repo}/README.md`
    const content = await axios.get(raw).then(res => {
      return res.data
    })

    return {
      metas: exercises.find(e => {
        return e.alias === params.alias
      }),
      exercise: content.split('![](').join('![](' + repo + '/')
    }
  }
}
</script>

<style lang="scss" scope>
</style>
