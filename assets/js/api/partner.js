import axios from 'axios';

export default {
    getPartners () {
        return axios.get('/api/v1/partners');
    },
    postPartners (partner) {
        return axios.post('/api/v1/partners',
            {
                name: partner.name,
                surname: partner.surname,
                email: partner.email
            });
    },
    patchPartners (partner) {
        return axios.patch('/api/v1/partners/' + partner.id);
    }
}