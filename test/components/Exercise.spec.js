import Vue from 'vue'
import { shallowMount } from '@vue/test-utils'
import Bootstrap from 'bootstrap-vue'

import Exercise from '@/components/Exercise.vue'
const exercise = {
  alias: 'alias',
  url: 'url',
  title: 'Title',
  description: 'Description',
  image: 'url-image',
  tags: ['tag 1', 'tag 2', 'tag 3'],
  authors: [
    {
      author: 'user'
    }
  ]
}

describe('Exercise', () => {
  beforeEach(() => {
    Vue.use(Bootstrap)
  })

  it('is a Vue instance', () => {
    const wrapper = shallowMount(Exercise, {
      propsData: {
        exercise: exercise
      }
    })
    expect(wrapper.isVueInstance()).toBeTruthy()
    // console.log(wrapper.html())
  })
})
