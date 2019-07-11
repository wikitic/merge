import Vue from 'vue'
import { mount } from '@vue/test-utils'
import Vuetify from 'vuetify'
import Markdown from '@/components/Exercise/Markdown.vue'

Vue.use(Vuetify)

describe('Markdown', () => {
  it('renders', () => {
    const exercise = {
      alias: 'alias',
      url: 'url',
      title: 'title',
      description: 'description',
      image: 'image',
      tags: ['tag 1', 'tag 2', 'tag 3'],
      authors: [
        {
          author: 'user'
        }
      ]
    }
    const content = '# title'
    const wrapper = mount(Markdown, {
      propsData: {
        exercise: exercise,
        content: content
      }
    })
    expect(wrapper.props().content).toBe('# title')
    expect(wrapper.html()).toContain('title')
  })
})
