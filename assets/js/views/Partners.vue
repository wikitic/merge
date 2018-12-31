<template>
    <v-container fluid>
        <v-card>
            <v-card-title>
                <v-text-field v-model="search" append-icon="search" label="Buscar" single-line hide-details></v-text-field>
            </v-card-title>
            <v-data-table :headers="headers" :items="partners" :search="search" item-key="id" :pagination.sync="pagination">
                <template slot="items" slot-scope="props">
                    <tr @click="props.expanded = !props.expanded">
                        <td>
                            <v-chip label small :color="getColorByStatus(props.item.active)" text-color="white" >
                                {{ props.item.code }}
                            </v-chip>
                        </td>
                        <td>{{ props.item.fullname }}</td>
                        <td>{{ props.item.email }}</td>
                        <td>{{ props.item.cdate }}</td>
                        <td>{{ props.item.mdate }}</td>
                        <td class="text-xs-right">
                            <v-btn flat icon color="grey">
                                <v-icon>edit</v-icon>
                            </v-btn>
                        </td>
                    </tr>
                </template>
                <template slot="expand" slot-scope="props">
                    <v-card flat>
                        <v-card-text>
                            
                            {{ props.item.subscriptions }}

                            <v-data-table :items="props.item.subscriptions" item-key="props.item.subscriptions.id">
                                <template slot="items" slot-scope="props">
                                    <tr>
                                        <td>{{ props.item.info }}</td>
                                        <td>{{ props.item.inDate }}</td>
                                        <td>{{ props.item.outDate }}</td>
                                        <td>{{ props.item.price }}</td>
                                    </tr>
                                </template>
                            </v-data-table>

                        </v-card-text>
                    </v-card>
                </template>
            </v-data-table>
        </v-card>
    </v-container>
</template>

<script>
    export default {
        name: 'partners',
        data () {
            return {
                search: '',
                pagination: {
                    rowsPerPage: 10
                },
                headers: [
                    { text: 'Código', value: 'code', sortable: false },
                    { text: 'Nombre y Apellidos', value: 'fullname'},
                    { text: 'Email', value: 'email' },
                    { text: 'CDate', value: 'cdate' },
                    { text: 'MDate', value: 'mdate' }
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
        },
        /*
        methods: {
            createPost () {
                this.$store.dispatch('post/createPost', this.$data.message)
                    .then(() => this.$data.message = '')
            },
        },
        */
    }
</script>