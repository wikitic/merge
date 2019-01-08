<template>
    <v-card color="grey lighten-4" class="white--text">
        <v-toolbar flat color="white">
            <v-spacer></v-spacer>
            <subscriptions-new :partner="partner"></subscriptions-new>
        </v-toolbar>
        <v-card-text>
            <v-data-table :headers="headers" :items="partner.subscriptions" item-key="id" :pagination.sync="pagination" hide-actions>
                <template slot="items" slot-scope="props">
                    <tr>
                        <td>
                            <v-chip :color="getColorByActive(isActive(props.item.inDate, props.item.outDate))" outline>
                                {{ toDate(props.item.inDate) }}
                            </v-chip>
                        </td>
                        <td>
                            <v-chip :color="getColorByActive(isActive(props.item.inDate, props.item.outDate))" outline>
                                {{ toDate(props.item.outDate) }}
                            </v-chip>
                        </td>
                        <td>{{ props.item.info }}</td>
                        <td>{{ props.item.price }}</td>
                        <td>
                            <subscriptions-edit :subscription="props.item"></subscriptions-edit>
                            <subscriptions-delete :partner="partner" :subscription="props.item"></subscriptions-delete>
                        </td>
                    </tr>
                </template>
            </v-data-table>
        </v-card-text>
    </v-card>
</template>

<script>
    import SubscriptionsNew from './New'
    import SubscriptionsEdit from './Edit'
    import SubscriptionsDelete from './Delete'

    export default {
        name: 'partners-subscriptions',
        props: ['partner'],
        components: {
            SubscriptionsNew,
            SubscriptionsEdit,
            SubscriptionsDelete
        },
        data () {
            return {
                headers: [
                    { text: 'Inicio', value: 'inDate', sortable: false, width:100 },
                    { text: 'Fin', value: 'outDate', sortable: false, width:100 },
                    { text: 'Info', value: 'info', sortable: false },
                    { text: 'Price', value: 'price', sortable: false, width:100 },
                    { text: '', sortable: false, width: 200 }
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
                let date = new Date(datetime)
                return date.toLocaleDateString("es-ES") //eu-ES
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