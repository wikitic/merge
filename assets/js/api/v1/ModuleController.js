import axios from 'axios'

export default {
    getModulesById (module) {
        return axios.get('/api/v1/modules/'+module.id)
    }  
}
