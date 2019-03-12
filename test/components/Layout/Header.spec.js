import Vue from 'vue'
import { mount } from '@vue/test-utils'
import Bootstrap from 'bootstrap-vue'

import Header from '@/components/Layout/Header.vue'

describe('Header', () => {
  beforeEach(() => {
    Vue.use(Bootstrap)
  })
  test('is a Vue instance', () => {
    const wrapper = mount(Header)
    expect(wrapper.isVueInstance()).toBeTruthy()
  })
})
