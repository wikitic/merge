import axios from 'axios'

export default {
    getLanguageByAlias (payload) {
        return axios.get('/api/v1/languages/'+payload.language)
    }  
}
