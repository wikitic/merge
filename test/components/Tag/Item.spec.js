import Vue from 'vue'
import { shallowMount } from '@vue/test-utils'
import Bootstrap from 'bootstrap-vue'

import TagItem from '@/components/Tag/Item.vue'
const tag = 'tag test'

describe('TagItem', () => {
  beforeEach(() => {
    Vue.use(Bootstrap)
  })
  it('is a Vue instance', () => {
    const wrapper = shallowMount(TagItem, {
      propsData: {
        tag: tag
      }
    })
    expect(wrapper.isVueInstance()).toBeTruthy()
    // console.log(wrapper.html())
  })
})
