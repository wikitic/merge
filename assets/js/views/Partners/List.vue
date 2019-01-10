<template>
    <v-container grid-list-xl fluid>

        <v-card>
            <v-toolbar flat color="white">
                <v-spacer></v-spacer>
                <partner-new></partner-new>
            </v-toolbar>
            <v-card-title>
                <v-text-field v-model="search" append-icon="search" label="Buscar" single-line hide-details></v-text-field>
            </v-card-title>
            <v-card-text>
                <v-data-table :headers="headers" :items="partners" item-key="id" :search="search" :pagination.sync="pagination">
                    <template slot="items" slot-scope="props">
                        <tr @click="props.expanded = !props.expanded">
                            <td>{{ props.item.id }}</td>
                            <td>
                                <v-chip label small :color="getColorByStatus(props.item.subscriptions)" text-color="white" >
                                    {{ props.item.code }}
                                </v-chip>
                            </td>
                            <td>{{ props.item.fullname }}</td>
                            <td>{{ props.item.email }}</td>
                            <td class="text-xs-center">
                                <v-chip>{{ props.item.numSubscriptions }}</v-chip>
                            </td>
                            <td>{{ toDate(props.item.cdate) }}</td>
                            <td>
                                <v-btn flat icon color="grey" @click="$router.push(`partners/${props.item.id}`)">
                                    <v-icon>visibility</v-icon>
                                </v-btn>
                                <!--
                                <partners-edit :partner="props.item"></partners-edit>
                                <partners-delete :partner="props.item"></partners-delete>
                                -->
                            </td>
                        </tr>
                    </template>
                    <template slot="expand" slot-scope="props">
                        <subscriptions-list :subscriptions="props.item.subscriptions"></subscriptions-list>
                    </template>
                </v-data-table>
            </v-card-text>
        </v-card>

    </v-container>
</template>



<script>
    import PartnerNew from '../../components/Dialogs/PartnerNew'
    import SubscriptionsList from '../../components/Tables/SubscriptionsList'

    export default {
        name: 'partners-list',
        components: {
            PartnerNew,
            SubscriptionsList
        },
        data () {
            return {
                dialog: false,
                search: '',
                pagination: {
                    sortBy: 'cdate',
                    descending: true,
                    rowsPerPage: 10
                },
                headers: [
                    { text: '#', value: 'id', width: 10 },
                    { text: 'Código', value: 'code', sortable: false, width: 100 },
                    { text: 'Nombre y Apellidos', value: 'fullname', sortable: false },
                    { text: 'Email', value: 'email', sortable: false, width: 300 },
                    { text: 'Suscripciones', value: 'numSubscriptions', width:50 },
                    { text: 'Registro', value: 'cdate', width:100 },
                    { text: '', sortable: false, width: 50 }
                ],
                colors: {
                    1: 'green',
                    0: 'red'
                }
            };
        },
        created () {
            this.$store.dispatch('partner/getPartners')
        },
        computed: {
            partners () {
                return this.$store.getters['partner/partners']
            }
        },
        methods: {
            toDate (datetime) {
                let date = new Date(datetime)
                return date.toLocaleDateString("es-ES") //eu-ES
            },
            getStatus (subscriptions) {
                let now = new Date()
                let inDate, outDate
                let first = subscriptions[0]
                let last = subscriptions[subscriptions.length-1]

                if(first === undefined || last === undefined)
                    return 0

                inDate = new Date(first.inDate)
                outDate = new Date(first.outDate)

                if(now > inDate && now < outDate)
                    return 1
                else
                    return 0
            },
            getColorByStatus (subscriptions) {
                return this.colors[this.getStatus(subscriptions)]
            }
        }
    }
</script>