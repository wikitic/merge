import Vue from 'vue'
import { shallowMount } from '@vue/test-utils'
import NotFound from '@/pages/404.vue'
import Vuetify from 'vuetify'

Vue.use(Vuetify)

describe('NotFound', () => {
  test('mounts properly', () => {
    const wrapper = shallowMount(NotFound)
    expect(wrapper.isVueInstance()).toBeTruthy()
  })
})
