import axios from 'axios'

export default {
    async getLessonByAlias (payload) {
        return await axios.get('/api/v1/languages/'+payload.language+'/modules/'+payload.module+'/lessons/'+payload.lesson)
    }  
}
