import Vue from 'vue'
import { mount } from '@vue/test-utils'
import Vuetify from 'vuetify'
import Footer from '@/components/Layout/Footer.vue'

Vue.use(Vuetify)

describe('Footer', () => {
  it('renders', () => {
    const wrapper = mount(Footer)
    expect(wrapper.html()).toContain('Asociación Programo Ergo Sum')
  })
})
