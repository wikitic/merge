<template>
    <v-container fluid>
        <v-card>
            <v-toolbar flat color="white">
                <v-toolbar-title>Socios</v-toolbar-title>
                <v-spacer></v-spacer>
                <partner-new></partner-new>
            </v-toolbar>
            <v-card-title>
                <v-text-field v-model="search" append-icon="search" label="Buscar" single-line hide-details></v-text-field>
            </v-card-title>
            <v-data-table :headers="headers" :items="partners" :search="search" item-key="id" :pagination.sync="pagination">
                <template slot="items" slot-scope="props">
                    <tr @click="props.expanded = !props.expanded">
                        <td>
                            <v-chip label small :color="getColorByStatus(props.item.subscriptions)" text-color="white" >
                                {{ props.item.code }}
                            </v-chip>
                        </td>
                        <td>{{ props.item.fullname }}</td>
                        <td>{{ props.item.email }}</td>
                        <td>{{ props.item.numSubscriptions }}</td>
                        <td>{{ toDate(props.item.cdate) }}</td>
                        <td class="text-xs-right">
                            <partner-edit :partner="props.item"></partner-edit>
                            <v-icon small>delete</v-icon>
                        </td>
                    </tr>
                </template>
                <template slot="expand" slot-scope="props">
                    <subscriptions :subscriptions="props.item.subscriptions"></subscriptions>
                </template>
            </v-data-table>
        </v-card>

    </v-container>
</template>

<script>
    import PartnerNew from '../components/Partners/PartnerNew';
    import PartnerEdit from '../components/Partners/PartnerEdit';
    import Subscriptions from '../components/Partners/Subscriptions';

    export default {
        name: 'partners',
        components: {
            PartnerNew,
            PartnerEdit,
            Subscriptions
        },
        data () {
            return {
                dialog: false,
                search: '',
                pagination: {
                    rowsPerPage: 10
                },
                headers: [
                    { text: 'Código', value: 'code', sortable: false },
                    { text: 'Nombre y Apellidos', value: 'fullname'},
                    { text: 'Email', value: 'email' },
                    { text: 'Suscripciones', value: 'numSubscriptions' },
                    { text: 'Registro', value: 'cdate' },
                    //{ text: 'MDate', value: 'mdate' }
                ],
                colors: {
                    1: 'green',
                    0: 'red'
                }
            };
        },
        created () {
            this.$store.dispatch('partner/getPartners');
        },
        computed: {
            partners () {
                return this.$store.getters['partner/partners'];
            },
        },
        methods: {
            toDate (datetime) {
                let date = datetime ? new Date(datetime) : null
                return date && date.toISOString().split('T')[0]
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