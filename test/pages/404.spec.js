import Vue from 'vue'
import { shallowMount } from '@vue/test-utils'
import Vuetify from 'vuetify'
import NotFound from '@/pages/404.vue'

Vue.use(Vuetify)

describe('NotFound', () => {
  test('mounts properly', () => {
    const wrapper = shallowMount(NotFound)
    expect(wrapper.isVueInstance()).toBeTruthy()
  })
})
