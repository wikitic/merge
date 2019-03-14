import Vue from 'vue'
import { mount } from '@vue/test-utils'
import Bootstrap from 'bootstrap-vue'
import Markdown from '@/components/Exercise/Markdown.vue'

Vue.use(Bootstrap)

describe('Markdown', () => {
  it('renders', () => {
    const content = '# title'
    const wrapper = mount(Markdown, {
      propsData: {
        content: content
      }
    })
    expect(wrapper.props().content).toBe('# title')
    expect(wrapper.html()).toContain('title')
  })
})
