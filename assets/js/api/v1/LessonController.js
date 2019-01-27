import axios from 'axios'

export default {
    getLessonByAlias (payload) {
        return axios.get('/api/v1/languages/'+payload.language+'/modules/'+payload.module+'/lessons/'+payload.lesson)
    }  
}
