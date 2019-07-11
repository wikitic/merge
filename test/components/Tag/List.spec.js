import Vue from 'vue'
import { mount } from '@vue/test-utils'
import Vuetify from 'vuetify'
import TagList from '@/components/Tag/List.vue'

Vue.use(Vuetify)

describe('TagList', () => {
  it('renders list', () => {
    const wrapper = mount(TagList, {
      stubs: ['nuxt-link']
    })
    expect(wrapper.html()).toContain('/tag/')
  })
})
