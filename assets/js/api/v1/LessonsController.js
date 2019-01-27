import axios from 'axios'

export default {
    getLessonsById (lesson) {
        return axios.get('/api/v1/lessons/'+lesson.id)
    }  
}
