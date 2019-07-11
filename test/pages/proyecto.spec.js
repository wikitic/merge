import Vue from 'vue'
import { shallowMount } from '@vue/test-utils'
import Vuetify from 'vuetify'
import Proyecto from '@/pages/proyecto.vue'

Vue.use(Vuetify)

describe('Proyecto', () => {
  test('mounts properly', () => {
    const wrapper = shallowMount(Proyecto)
    expect(wrapper.isVueInstance()).toBeTruthy()
  })
})
