import Vue from 'vue'
import { mount } from '@vue/test-utils'
import Forkme from '@/components/Layout/Forkme.vue'
import Vuetify from 'vuetify'

Vue.use(Vuetify)

describe('Forkme', () => {
  it('renders', () => {
    const wrapper = mount(Forkme)
    const href = 'https://github.com/wikitic/wikitic.github.io'
    expect(wrapper.html()).toContain(href)
  })
})
