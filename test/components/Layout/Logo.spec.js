import Vue from 'vue'
import { mount, shallowMount } from '@vue/test-utils'
import Logo from '@/components/Layout/Logo.vue'
import Vuetify from 'vuetify'

describe('Logo', () => {
  beforeEach(() => {
    Vue.use(Vuetify)
  })
  test('is a Vue instance', () => {
    const wrapper = mount(Logo)
    expect(wrapper.isVueInstance()).toBeTruthy()
  })
  test('renders properly', () => {
    const wrapper = shallowMount(Logo)
    expect(wrapper.html()).toMatchSnapshot()
    expect(wrapper.html()).toContain('TIC')
  })
})
