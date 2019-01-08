import axios from 'axios'

export default {
    login (user) {
        return axios.post('/api/v1/login',
            {
                username: user.username,
                password: user.password
            }
        )
    },
    logout () {
        return axios.get('/api/v1/logout')
    }
}