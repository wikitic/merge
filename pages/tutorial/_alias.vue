<template>
  <div>
    <Metas
      :metas="exercise"
    />
    <Markdown
      :exercise="exercise"
      :content="content"
      :url="url"
    />
  </div>
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
    const doc = await axios.get(raw).then(res => {
      return res.data
    })
    const url = `https://github.com/wikitic/${params.alias}/tree/master/es`

    let content = doc
    content = content.split('![](').join('![](' + repo + '')
    content = content.split('](#').join(`](/${params.alias}#`)

    return {
      exercise: exercises.find(e => {
        return e.alias === params.alias
      }),
      content: content,
      url: url
    }
  },
  head() {
    return {
      script: [
        {
          src: '//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js',
          async: true
        },
        {
          innerHTML:
            '(adsbygoogle = window.adsbygoogle || []).push({ google_ad_client: "ca-pub-6757981017018187", enable_page_level_ads: true});'
        }
      ]
    }
  }
}
</script>

<style lang="scss" scoped>
</style>
