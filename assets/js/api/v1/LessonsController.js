import axios from 'axios'

export default {
    getLessons (language, module) {
        return axios.get('/api/v1/'+language+'/'+module+'/lessons')
    }  
}