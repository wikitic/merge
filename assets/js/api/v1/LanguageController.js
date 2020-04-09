import axios from 'axios'

export default {
    async getLanguageByAlias (payload) {
        return axios.get('/api/v1/languages/'+payload.language)
    }  
}
