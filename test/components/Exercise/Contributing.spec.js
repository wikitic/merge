import Vue from 'vue'
import { mount } from '@vue/test-utils'
import Contributing from '@/components/Exercise/Contributing.vue'
import Vuetify from 'vuetify'

Vue.use(Vuetify)

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
