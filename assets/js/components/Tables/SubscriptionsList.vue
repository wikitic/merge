<template>
    <v-data-table :headers="headers" :items="subscriptions" item-key="id" :pagination.sync="pagination" hide-actions>
        <template slot="items" slot-scope="props">
            <tr>
                <td>{{ props.item.id }}</td>
                <td>
                    <v-icon v-if="isSubscriber(props.item)" x-large color="green">done</v-icon>
                    <v-icon v-else x-large color="red">clear</v-icon>
                </td>
                <td>{{ toDate(props.item.inDate) }}</td>
                <td>{{ toDate(props.item.outDate) }}</td>
                <td>{{ props.item.info }}</td>
                <td>{{ props.item.price }}</td>
            </tr>
        </template>
    </v-data-table>
</template>

<script>
    export default {
        name: 'subscriptions-list',
        props: {
            subscriptions: {
                type: Array,
                default: null
            }
        },
        data () {
            return {
                headers: [
                    { text: '#', value: 'id', sortable: false, width: 10 },
                    { text: 'Estado', value: '', sortable: false, width: 50 },
                    { text: 'Inicio', value: 'inDate', sortable: false, width:100 },
                    { text: 'Fin', value: 'outDate', sortable: false, width:100 },
                    { text: 'Info', value: 'info', sortable: false },
                    { text: 'Price', value: 'price', sortable: false, width:100 }
                ],
                pagination: {
                    rowsPerPage: -1
                }
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