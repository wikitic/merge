import axios from 'axios'

export default {
    getLanguagesByAlias (language) {
        return axios.get('/api/v1/language/'+language.alias)
    }  
}
