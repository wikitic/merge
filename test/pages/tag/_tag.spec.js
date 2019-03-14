import Vue from 'vue'
import { shallowMount } from '@vue/test-utils'
import Bootstrap from 'bootstrap-vue'

import Tag from '@/pages/tag/_tag.vue'

Vue.use(Bootstrap)

describe('Tag', () => {
  test('mounts properly', () => {
    const wrapper = shallowMount(Tag)
    expect(wrapper.isVueInstance()).toBeTruthy()
  })
})
