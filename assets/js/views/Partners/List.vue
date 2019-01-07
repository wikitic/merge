<template>
    <v-container fluid>
        <v-card>
            <v-toolbar flat color="white">
                <v-toolbar-title>Socios</v-toolbar-title>
                <v-spacer></v-spacer>
                <partners-new></partners-new>
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
                            <td class="text-xs-center">{{ props.item.numSubscriptions }}</td>
                            <td>{{ toDate(props.item.cdate) }}</td>
                            <td>
                                <v-chip v-if="getAlta(props.item.subscriptions)" :color="getColorByStatus(props.item.subscriptions)" outline>
                                    {{ getAlta(props.item.subscriptions) }}
                                </v-chip>
                            </td>
                            <td>
                                <v-chip v-if="getBaja(props.item.subscriptions)" :color="getColorByStatus(props.item.subscriptions)" outline>
                                    {{ getBaja(props.item.subscriptions) }}
                                </v-chip>
                            </td>
                            <td>
                                <partners-edit :partner="props.item"></partners-edit>
                                <partners-delete :partner="props.item"></partners-delete>
                            </td>
                        </tr>
                    </template>
                    <template slot="expand" slot-scope="props">
                        <partners-subscriptions :subscriptions="props.item.subscriptions"></partners-subscriptions>
                    </template>
                </v-data-table>
            </v-card-text>
        </v-card>

    </v-container>
</template>

<script>
    import PartnersNew from './New'
    import PartnersEdit from './Edit'
    import PartnersDelete from './Delete'

    import PartnersSubscriptions from './Subscriptions/List'

    export default {
        name: 'partners-list',
        components: {
            PartnersNew,
            PartnersEdit,
            PartnersDelete,
            PartnersSubscriptions
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
                    { text: 'Código', value: 'code', sortable: false, width: 50 },
                    { text: 'Nombre y Apellidos', value: 'fullname'},
                    { text: 'Email', value: 'email', sortable: false, width: 200 },
                    { text: 'Suscripciones', value: 'numSubscriptions', width:50, align: 'center' },
                    { text: 'Registro', value: 'cdate', width:100 },
                    { text: 'Alta', sortable: false, width:100 },
                    { text: 'Baja', sortable: false, width:100 },
                    { text: '', sortable: false, width: 160 }
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
            getAlta (subscriptions) {
                let subs = subscriptions[subscriptions.length-1]
                
                if(subs === undefined)
                    return null
                
                return this.toDate(new Date(subs.inDate))

            },
            getBaja (subscriptions) {
                let subs = subscriptions[0]
                
                if(subs === undefined)
                    return null
                
                return this.toDate(new Date(subs.outDate))

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