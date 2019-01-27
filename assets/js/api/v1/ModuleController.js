import axios from 'axios'

export default {
    getModuleByAlias (payload) {
        return axios.get('/api/v1/languages/'+payload.language+'/modules/'+payload.module)
    }  
}
