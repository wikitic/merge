import axios from 'axios'

export default {
    login (partner) {
        return axios.post('/api/v1/login',
            {
                email: partner.email,
                password: partner.password
            }
        )
    },
    logout () {
        return axios.get('/api/v1/logout')
    }
}