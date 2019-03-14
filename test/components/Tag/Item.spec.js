import Vue from 'vue'
import { mount } from '@vue/test-utils'
import Bootstrap from 'bootstrap-vue'
import TagItem from '@/components/Tag/Item.vue'

Vue.use(Bootstrap)

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

  it('renders empty tag', () => {
    const tag = ''
    const wrapper = mount(TagItem, {
      propsData: {
        tag: tag
      }
    })
    expect(wrapper.props().tag).toBe('')
    expect(wrapper.html()).toBe(undefined)
  })
})
