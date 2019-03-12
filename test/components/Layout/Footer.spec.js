import Vue from 'vue'
import { mount } from '@vue/test-utils'
import Bootstrap from 'bootstrap-vue'

import Footer from '@/components/Layout/Footer.vue'

describe('Footer', () => {
  beforeEach(() => {
    Vue.use(Bootstrap)
  })
  test('is a Vue instance', () => {
    const wrapper = mount(Footer)
    expect(wrapper.isVueInstance()).toBeTruthy()
  })
})
