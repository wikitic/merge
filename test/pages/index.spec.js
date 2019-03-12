import Vue from 'vue'
import { shallowMount } from '@vue/test-utils'
import Bootstrap from 'bootstrap-vue'

import Index from '@/pages/index.vue'

Vue.use(Bootstrap)

describe('Index', () => {
  test('mounts properly', () => {
    const wrapper = shallowMount(Index)
    expect(wrapper.isVueInstance()).toBeTruthy()
  })
})
