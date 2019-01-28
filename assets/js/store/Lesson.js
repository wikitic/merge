import LessonAPI from '../api/v1/LessonController'

export default {
    namespaced: true,
    state: {
        lesson: []
    },
    getters: {
        lesson (state) {
            return state.lesson
        }
    },
    mutations: {
        ['INIT'](state, lesson) {
            state.lesson = []
        },
        ['GET_LESSON_SUCCESS'](state, lesson) {
            state.lesson = lesson
        }
    },
    actions: {
        getLesson ({commit}, payload) {
            commit('INIT', null)
            return new Promise( (resolve, reject) => {
                LessonAPI.getLessonByAlias(payload)
                    .then(res => {
                        //setTimeout(() => {
                            commit('GET_LESSON_SUCCESS', res.data)
                            resolve(res.data)
                        //},1000)
                    }).catch( err => {
                    reject(err)
                })
            })
        }
    }
}
