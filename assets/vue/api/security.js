import axios from 'axios';

export default {
    login (username, password) {
        return axios.post(
            '/api/v1/login',
            {
                username: username,
                password: password
            }
        );
    },
}