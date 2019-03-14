import Vue from 'vue'
import { mount } from '@vue/test-utils'
import Bootstrap from 'bootstrap-vue'
import Header from '@/components/Layout/Header.vue'

Vue.use(Bootstrap)

describe('Header', () => {
  it('renders', () => {
    const wrapper = mount(Header, {
      stubs: ['nuxt-link']
    })
    expect(wrapper.html()).toContain('Wiki')
  })
})
