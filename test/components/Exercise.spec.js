import Vue from 'vue'
import { shallowMount } from '@vue/test-utils'
import Exercise from '@/components/Exercise.vue'
import Vuetify from 'vuetify'

Vue.use(Vuetify)

describe('Exercise', () => {
  it('renders', () => {
    const exercise = {
      alias: 'alias',
      url: 'url',
      title: 'title',
      description: 'description',
      image: 'image',
      tags: ['tag 1', 'tag 2', 'tag 3'],
      authors: [
        {
          author: 'user'
        }
      ]
    }
    const wrapper = shallowMount(Exercise, {
      propsData: {
        exercise: exercise
      },
      stubs: ['nuxt-link']
    })
    expect(wrapper.isVueInstance()).toBeTruthy()
    expect(wrapper.props().exercise.alias).toBe('alias')
    expect(wrapper.props().exercise.url).toBe('url')
    expect(wrapper.props().exercise.title).toBe('title')
    expect(wrapper.props().exercise.description).toBe('description')
    expect(wrapper.props().exercise.image).toBe('image')
  })
})
