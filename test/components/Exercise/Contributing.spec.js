import Vue from 'vue'
import { mount } from '@vue/test-utils'
import Bootstrap from 'bootstrap-vue'

import Contributing from '@/components/Exercise/Contributing.vue'

describe('Contributing', () => {
  beforeEach(() => {
    Vue.use(Bootstrap)
  })
  test('is a Vue instance', () => {
    const wrapper = mount(Contributing)
    expect(wrapper.isVueInstance()).toBeTruthy()
  })
})
