import axios from 'axios';

export default {
    getPartners () {
        return axios.get('/api/v1/partners');
    },
}