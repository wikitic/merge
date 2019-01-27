import LessonsAPI from '../api/v1/LessonsController'

export default {
    namespaced: true,
    state: {
        lessons: []
    },
    getters: {
        lessons (state) {
            return state.lessons
        },
    },
    mutations: {
        ['GET_LESSONS_SUCCESS'](state, lessons) {
            state.lessons = lessons
        }
    },
    actions: {
        getLessons ({commit}, language, module) {
            return LessonsAPI.getLessons(language, module)
                .then(res => commit('GET_LESSONS_SUCCESS', res.data))
        }
    }
}