import courses from '~/store/api/v1/courses.json'

const state = () => ({
  list: courses
})

const getters = {
  findAll: state => state.list
}

const actions = {}

const mutations = {}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
