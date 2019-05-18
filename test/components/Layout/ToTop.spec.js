import Vue from 'vue'
import { mount } from '@vue/test-utils'
import ToTop from '@/components/Layout/ToTop.vue'
import Vuetify from 'vuetify'

Vue.use(Vuetify)

describe('ToTop', () => {
  beforeEach(() => {
    Vue.use(Vuetify)
  })
  test('is a Vue instance', () => {
    const wrapper = mount(ToTop)
    expect(wrapper.isVueInstance()).toBeTruthy()
  })
})
