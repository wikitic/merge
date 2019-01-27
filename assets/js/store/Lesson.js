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
        ['GET_LESSON_SUCCESS'](state, lesson) {
            state.lesson = lesson
        }
    },
    actions: {
        getLesson ({commit}, lesson) {
            return LessonAPI.getLessonsById(lesson)
                .then(res => commit('GET_LESSON_SUCCESS', res.data))
        }
    }
}
