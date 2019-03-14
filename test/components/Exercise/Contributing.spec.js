import Vue from 'vue'
import { mount } from '@vue/test-utils'
import Bootstrap from 'bootstrap-vue'
import Contributing from '@/components/Exercise/Contributing.vue'

Vue.use(Bootstrap)

describe('Contributing', () => {
  it('renders', () => {
    const url = 'url'
    const wrapper = mount(Contributing, {
      propsData: {
        url: url
      },
      stubs: ['nuxt-link']
    })
    expect(wrapper.props().url).toBe('url')
    expect(wrapper.html()).toContain('url')
  })
})
