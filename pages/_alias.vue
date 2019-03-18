<template>
  <div>
    <Head
      :exercise="exercise"
    />
    <b-container>
      <b-row>
        <b-col cols="12" sm="12" md="1" lg="2" />
        <b-col cols="12" sm="12" md="10" lg="8">
          <Metas
            :metas="exercise"
          />
          <Markdown
            :exercise="exercise"
            :content="content" 
          />
          <Contributing
            :url="url" 
          />
        </b-col>
        <b-col cols="12" sm="12" md="1" lg="2" />
      </b-row>
    </b-container>
  </div>
</template>

<script>
import axios from 'axios'
import exercises from '@/static/exercises.json'
import Metas from '@/components/Layout/Metas'
import Head from '@/components/Exercise/Head'
import Markdown from '@/components/Exercise/Markdown'
import Contributing from '@/components/Exercise/Contributing'

export default {
  components: {
    Metas,
    Head,
    Markdown,
    Contributing
  },
  async asyncData({ params }) {
    const API_EX = 'https://raw.githubusercontent.com/wikitic/'
    const repo = `${API_EX}${params.alias}/master/es/`
    const raw = `${repo}/README.md`
    const content = await axios.get(raw).then(res => {
      return res.data
    })
    const url = `https://github.com/wikitic/${params.alias}/tree/master/es`

    return {
      exercise: exercises.find(e => {
        return e.alias === params.alias
      }),
      content: content.split('![](').join('![](' + repo + ''),
      url: url
    }
  }
}
</script>

<style lang="scss" scoped>
</style>
