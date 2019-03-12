<template>
  <b-container>
    <b-row>
      <b-col cols="12" sm="12" md="1" lg="2" />
      <b-col cols="12" sm="12" md="10" lg="8">
        <Metas
          :metas="metas"
        />
        <Markdown
          :content="exercise" 
        />
      </b-col>
      <b-col cols="12" sm="12" md="1" lg="2" />
    </b-row>
  </b-container>
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

<style lang="scss" scoped>
</style>
