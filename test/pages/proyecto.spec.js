import Vue from 'vue'
import { shallowMount } from '@vue/test-utils'
import Proyecto from '@/pages/proyecto.vue'
import Vuetify from 'vuetify'

Vue.use(Vuetify)

describe('Proyecto', () => {
  test('mounts properly', () => {
    const wrapper = shallowMount(Proyecto)
    expect(wrapper.isVueInstance()).toBeTruthy()
  })
})
