import Vue from 'vue'
import { mount } from '@vue/test-utils'
import Markdown from '@/components/Exercise/Markdown.vue'
import Vuetify from 'vuetify'

describe('Markdown', () => {
  beforeEach(() => {
    Vue.use(Vuetify)
  })
  test('is a Vue instance', () => {
    const wrapper = mount(Markdown)
    expect(wrapper.isVueInstance()).toBeTruthy()
  })
})
