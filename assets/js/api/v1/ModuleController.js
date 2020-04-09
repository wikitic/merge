import axios from 'axios'

export default {
    async getModuleByAlias (payload) {
        return await axios.get('/api/v1/languages/'+payload.language+'/modules/'+payload.module)
    }  
}
