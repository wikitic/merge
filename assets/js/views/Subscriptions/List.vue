<template>
    <v-container grid-list-xl fluid>

        <v-toolbar color="grey lighten-1">
            <v-toolbar-title>{{name}}</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn color="orange">Nueva Suscripción</v-btn>
        </v-toolbar>

        <v-card>
            <v-card-text>
                <v-data-table :headers="headers" :items="subscriptions" item-key="id" :pagination.sync="pagination" hide-actions>
                    <template slot="items" slot-scope="props">
                        <tr>
                            <td>{{ props.item.id }}</td>
                            <td>
                                <v-icon v-if="isSubscriber(props.item)" x-large color="green">done</v-icon>
                                <v-icon v-if="!isSubscriber(props.item)" x-large color="red">clear</v-icon>
                            </td>
                            <td>{{ toDate(props.item.inDate) }}</td>
                            <td>{{ toDate(props.item.outDate) }}</td>
                            <td>{{ props.item.info }}</td>
                            <td>{{ props.item.price }}</td>
                            <td>
                                <subscriptions-edit :subscription="props.item"></subscriptions-edit>
                                <subscriptions-delete :subscription="props.item"></subscriptions-delete>
                            </td>
                        </tr>
                    </template>
                </v-data-table>
            </v-card-text>
        </v-card>

    </v-container>
</template>



<script>
    import SubscriptionsEdit from './Edit'

    export default {
        name: 'subscriptions',
        components: {
            SubscriptionsEdit
        },
        data: () => ({
            pagination: {
                sortBy: 'inDate',
                descending: true,
                rowsPerPage: 10
            },
            headers: [
                { text: '#', value: 'id', sortable: false, width: 10 },
                { text: 'Estado', value: '', sortable: false, width: 50 },
                { text: 'Inicio', value: 'inDate', sortable: false, width: 100},
                { text: 'Fin', value: 'outDate', sortable: false, width: 100 },
                { text: 'Info', value: 'info', sortable: false },
                { text: 'Precio', sortable: false, width:100 },
                { text: '', sortable: false, width: 200 }
            ],
        }),
        created () {
            this.$store.dispatch('subscription/getPartnerSubscriptions', this.$route.params.idPartner)
        },
        computed: {
            subscriptions () {
                return this.$store.getters['subscription/subscriptions']
            },
            name () {                
                let subscription = this.$store.getters['subscription/subscriptions']
                return this.$store.getters['subscription/hasSubscriptions'] ? subscription[0].partner.fullname : ''
            }
        },
        methods: {
            toDate (datetime) {
                let date = new Date(datetime)
                return date.toLocaleDateString("es-ES") //eu-ES
            },
            isSubscriber (subscription) {
                let now = new Date()
                let inDate = new Date(subscription.inDate)
                let outDate = new Date(subscription.outDate)

                if(now > inDate && now < outDate)
                    return 1
                else
                    return 0
            }
        }
    }
</script>