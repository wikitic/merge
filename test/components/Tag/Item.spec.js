import Vue from 'vue'
import { mount } from '@vue/test-utils'
import TagItem from '@/components/Tag/Item.vue'
import Vuetify from 'vuetify'

Vue.use(Vuetify)

describe('TagItem', () => {
  it('renders tag', () => {
    const tag = 'tag test'
    const wrapper = mount(TagItem, {
      propsData: {
        tag: tag
      },
      stubs: ['nuxt-link']
    })
    expect(wrapper.props().tag).toBe('tag test')
    expect(wrapper.html()).toContain('/tag/tag+test')
    expect(wrapper.html()).toContain('tag test')
  })
})
