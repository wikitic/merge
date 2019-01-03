<template>
    <v-container fluid>
        <v-card>
            <v-card-title>
                <v-text-field v-model="search" append-icon="search" label="Buscar" single-line hide-details></v-text-field>
            </v-card-title>
            <v-data-table :headers="headers" :items="partners" :search="search" item-key="id" :pagination.sync="pagination">
                <template slot="items" slot-scope="props">
                    <tr @click="props.expanded = !props.expanded">
                        <td>{{ props.item.numSubscriptions }}</td>
                        <td>
                            <v-chip label small :color="getColorByStatus(props.item.active)" text-color="white" >
                                {{ props.item.code }}
                            </v-chip>
                        </td>
                        <td>{{ props.item.fullname }}</td>
                        <td>{{ props.item.email }}</td>
                        <!--
                        <td>{{ props.item.cdate }}</td>
                        <td>{{ props.item.mdate }}</td>
                        -->
                        <td class="text-xs-right">
                            <partner-edit :partner="props.item"></partner-edit>
                        </td>
                    </tr>
                </template>
                <template slot="expand" slot-scope="props">
                    <v-card flat>
                        <v-card-text>
                            <subscriptions :subscriptions="props.item.subscriptions"></subscriptions>
                        </v-card-text>
                    </v-card>
                </template>
            </v-data-table>
        </v-card>
    </v-container>
</template>

<script>
    import PartnerEdit from '../components/Partners/PartnerEdit';
    import Subscriptions from '../components/Partners/Subscriptions';

    export default {
        name: 'partners',
        components: {
            PartnerEdit,
            Subscriptions
        },
        data () {
            return {
                search: '',
                pagination: {
                    rowsPerPage: 10
                },
                headers: [
                    { text: 'Suscripciones', value: 'numSubscriptions' },
                    { text: 'Código', value: 'code', sortable: false },
                    { text: 'Nombre y Apellidos', value: 'fullname'},
                    { text: 'Email', value: 'email' },
                    //{ text: 'CDate', value: 'cdate' },
                    //{ text: 'MDate', value: 'mdate' }
                ],
                colors: {
                    1: 'green',
                    0: 'red'
                }
            };
        },
        created () {
            this.$store.dispatch('partner/fetchPartners');
        },
        computed: {
            /*
            isLoading () {
                return this.$store.getters['partner/isLoading'];
            },
            hasError () {
                return this.$store.getters['partner/hasError'];
            },
            error () {
                return this.$store.getters['partner/error'];
            },
            hasPartners () {
                return this.$store.getters['partner/hasPartners'];
            },
            */
            partners () {
                return this.$store.getters['partner/partners'];
            },
        },
        methods: {
            getColorByStatus (status) {
                return this.colors[status];
            }
        }
    }
</script>