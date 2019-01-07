import axios from 'axios'

export default {
    /*
    getPartners () {
        return axios.get('/api/v1/partners')
    },
    */
    postSubscriptions (subscription) {
        return axios.post('/api/v1/partners/' + subscription.partner.id + '/subscriptions',
            {
                inDate: subscription.inDate,
                outDate: subscription.outDate,
                info: subscription.info,
                price: subscription.price
            })
    },
    /*
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
    */ 
}