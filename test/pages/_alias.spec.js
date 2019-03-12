import Vue from 'vue'
import { shallowMount } from '@vue/test-utils'
import Bootstrap from 'bootstrap-vue'

import Alias from '@/pages/_alias.vue'

Vue.use(Bootstrap)

describe('Alias', () => {
  test('mounts properly', () => {
    const wrapper = shallowMount(Alias)
    expect(wrapper.isVueInstance()).toBeTruthy()
  })
})
