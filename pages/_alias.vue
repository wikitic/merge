<template>
  <v-container>
    <v-layout
      row 
      wrap
    >
      <v-flex 
        xs12
      >
        <Markdown
          :content="exercise" 
        />
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import axios from 'axios'
import Markdown from '@/components/Exercise/Markdown'

export default {
  components: {
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
      exercise: content.split('![](').join('![](' + repo + '/')
    }
  },
  head() {
    return {
      title: 'Wiki TIC'
    }
  }
}
</script>

<style lang="scss" scope>
</style>
