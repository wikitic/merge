import Vue from 'vue'
import { shallowMount } from '@vue/test-utils'
import Vuetify from 'vuetify'
import Tag from '@/pages/tag/_tag.vue'

Vue.use(Vuetify)

describe('Tag', () => {
  test('mounts properly', () => {
    const wrapper = shallowMount(Tag)
    expect(wrapper.isVueInstance()).toBeTruthy()
  })
})
