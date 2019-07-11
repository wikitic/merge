import Vue from 'vue'
import { shallowMount } from '@vue/test-utils'
import Vuetify from 'vuetify'
import Alias from '@/pages/tutorial/_alias.vue'

Vue.use(Vuetify)

describe('Alias', () => {
  test('mounts properly', () => {
    const wrapper = shallowMount(Alias)
    expect(wrapper.isVueInstance()).toBeTruthy()
  })
})
