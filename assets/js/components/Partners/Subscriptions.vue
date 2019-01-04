<template>
    <v-card color="orange lighten-4" class="white--text">
        <v-container fluid grid-list-lg>
            <v-data-table :headers="headers" :items="subscriptions" item-key="id" :pagination.sync="pagination" hide-actions>
                <template slot="items" slot-scope="props">
                    <tr>
                        <td>{{ props.item.info }}</td>
                        <td>{{ props.item.price }}</td>
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
                    </tr>
                </template>
            </v-data-table>
        </v-container>
    </v-card>
</template>

<script>
    export default {
        name: 'subscriptions',
        props: ['subscriptions'],
        data () {
            return {
                headers: [
                    { text: 'Info', value: 'info', sortable: false },
                    { text: 'Price', value: 'price', sortable: false },
                    { text: 'Inicio', value: 'inDate', sortable: false },
                    { text: 'Fin', value: 'outDate', sortable: false }
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