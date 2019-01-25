import axios from 'axios'

export default {
    getModules (language) {
        return axios.get('/api/v1/'+language+'/modules')
    }  
}