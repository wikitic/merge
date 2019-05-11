import Vue from 'vue'
import { mount } from '@vue/test-utils'
import Bootstrap from 'bootstrap-vue'
import Footer from '@/components/Layout/Footer.vue'

Vue.use(Bootstrap)

describe('Footer', () => {
  it('renders', () => {
    const wrapper = mount(Footer)
    expect(wrapper.html()).toContain('Asociación Programo Ergo Sum')
  })
})
