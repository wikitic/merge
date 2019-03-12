import Vue from 'vue'
import { mount } from '@vue/test-utils'
import Metas from '@/components/Layout/Metas.vue'
import Vuetify from 'vuetify'

describe('Metas', () => {
  beforeEach(() => {
    Vue.use(Vuetify)
  })
  test('is a Vue instance', () => {
    const wrapper = mount(Metas)
    expect(wrapper.isVueInstance()).toBeTruthy()
  })
})
