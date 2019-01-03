import axios from 'axios';

export default {
    getPartners () {
        return axios.get('/api/v1/partners');
    },

    patchPartners (partner) {
        return axios.patch('/api/v1/partners/' + partner.id);
    }
}