import axios from 'axios'

export default {
    getPartners () {
        return axios.get('/api/v1/partners')
    },
    postPartners (partner) {
        return axios.post('/api/v1/partners',
            {
                name: partner.name,
                surname: partner.surname,
                email: partner.email,
                active: partner.active,
                role: partner.role
            })
    },
    patchPartners (partner) {
        return axios.patch('/api/v1/partners/' + partner.id,
            {
                name: partner.name,
                surname: partner.surname,
                email: partner.email
            })
    },
    deletePartners (partner) {
        return axios.delete('/api/v1/partners/' + partner.id)
    }    
}