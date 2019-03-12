import Vue from 'vue'
import { mount } from '@vue/test-utils'
import Bootstrap from 'bootstrap-vue'

import Metas from '@/components/Layout/Metas.vue'

describe('Metas', () => {
  beforeEach(() => {
    Vue.use(Bootstrap)
  })
  test('is a Vue instance', () => {
    const wrapper = mount(Metas)
    expect(wrapper.isVueInstance()).toBeTruthy()
  })
})
