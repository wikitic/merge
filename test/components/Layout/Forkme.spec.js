import Vue from 'vue'
import { mount } from '@vue/test-utils'
import Bootstrap from 'bootstrap-vue'
import Forkme from '@/components/Layout/Forkme.vue'

Vue.use(Bootstrap)

describe('Forkme', () => {
  it('renders', () => {
    const wrapper = mount(Forkme)
    expect(wrapper.html()).toContain('href=\"https://github.com/wikitic/wikitic.github.io\"')
  })
})
