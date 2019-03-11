import Vue from 'vue'
import { shallowMount } from '@vue/test-utils'
import Alias from '@/pages/_alias.vue'
import Vuetify from 'vuetify'

Vue.use(Vuetify)

describe('Alias', () => {
  test('mounts properly', () => {
    const wrapper = shallowMount(Alias)
    expect(wrapper.isVueInstance()).toBeTruthy()
  })
})
