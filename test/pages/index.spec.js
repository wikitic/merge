import Vue from 'vue'
import { shallowMount } from '@vue/test-utils'
import Vuetify from 'vuetify'
import Index from '@/pages/index.vue'

Vue.use(Vuetify)

describe('Index', () => {
  test('mounts properly', () => {
    const wrapper = shallowMount(Index)
    expect(wrapper.isVueInstance()).toBeTruthy()
  })
})
