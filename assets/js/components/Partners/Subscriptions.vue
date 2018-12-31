<template>
    <v-data-table :headers="headers" :items="subscriptions" item-key="id" :pagination.sync="pagination">
        <template slot="items" slot-scope="props">
            <tr>
                <td>
                    <v-chip label small :color="getColorByActive(isActive(props.item.inDate, props.item.outDate))" text-color="white" >
                        Ok
                    </v-chip>
                </td>
                <td>{{ props.item.info }}</td>
                <td>{{ props.item.price }}</td>
                <td>{{ toDate(props.item.inDate) }}</td>
                <td>{{ toDate(props.item.outDate) }}</td>
            </tr>
        </template>
    </v-data-table>
</template>

<script>
    export default {
        name: 'subscriptions',
        props: ['subscriptions'],
        data () {
            return {
                headers: [
                    { text: 'Active', value: '', sortable: false },
                    { text: 'Info', value: 'info', sortable: false },
                    { text: 'Price', value: 'price', sortable: false },
                    { text: 'Inicio', value: 'inDate', sortable: false },
                    { text: 'Fin', value: 'outDate', sortable: false },
                ],
                colors: {
                    true: 'green',
                    false: 'red'
                },
                pagination: {
                    rowsPerPage: -1
                }
            }
        },
        methods: {
            toDate (datetime) {
                let date = datetime ? new Date(datetime) : null
                return date && date.toISOString().split('T')[0]
            },
            isActive(inDate, outDate) {
                let now = new Date()
                inDate = new Date(inDate)
                outDate = new Date(outDate)
                return now > inDate && now < outDate
            },
            getColorByActive (status) {
                return this.colors[status];
            }
        }
    }
</script>