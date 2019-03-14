import Vue from 'vue'
import { mount } from '@vue/test-utils'
import Bootstrap from 'bootstrap-vue'
import TagList from '@/components/Tag/List.vue'

Vue.use(Bootstrap)

describe('TagList', () => {
  it('renders list', () => {
    const wrapper = mount(TagList, {
      stubs: ['nuxt-link']
    })
    expect(wrapper.html()).toContain('/tag/')
  })
})
