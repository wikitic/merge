import Vue from 'vue'
import { shallowMount } from '@vue/test-utils'
import Bootstrap from 'bootstrap-vue'
import Head from '@/components/Exercise/Head.vue'

Vue.use(Bootstrap)

describe('Head', () => {
  it('renders', () => {
    const exercise = {
      title: 'title',
      image: 'image'
    }
    const wrapper = shallowMount(Head, {
      propsData: {
        exercise: exercise
      }
    })
    expect(wrapper.isVueInstance()).toBeTruthy()
    expect(wrapper.props().exercise.title).toBe('title')
    expect(wrapper.props().exercise.image).toBe('image')
  })
})
