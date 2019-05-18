import Vue from 'vue'
import { shallowMount } from '@vue/test-utils'
import Tag from '@/pages/tag/_tag.vue'
import Vuetify from 'vuetify'

Vue.use(Vuetify)

describe('Tag', () => {
  test('mounts properly', () => {
    const wrapper = shallowMount(Tag)
    expect(wrapper.isVueInstance()).toBeTruthy()
  })
})
