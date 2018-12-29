<template>
    <v-container fluid>
        <v-card>
            <v-card-title>
                <v-text-field v-model="search" append-icon="search" label="Buscar" single-line hide-details></v-text-field>
            </v-card-title>
            <v-data-table :headers="headers" :items="partners" :search="search" item-key="id" >
                <template slot="items" slot-scope="props">
                    <tr @click="props.expanded = !props.expanded">
                        <td>{{ props.item.code }}</td>
                        <td>{{ props.item.name }}</td>
                        <td>{{ props.item.surname }}</td>
                        <td>{{ props.item.email }}</td>
                        <td>{{ props.item.role }}</td>
                        <td>{{ props.item.cdate }}</td>
                        <td>{{ props.item.mdate }}</td>
                    </tr>
                </template>
                <template slot="expand" slot-scope="props">
                    <v-card flat>
                        <v-card-text>{{ props.item.subscriptions }}</v-card-text>
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
                headers: [
                    { text: 'Código', value: 'code', sortable: false },
                    { text: 'Nombre', value: 'name'},
                    { text: 'Apellidos',  value: 'surname' },
                    { text: 'Email', value: 'email' },
                    { text: 'Rol', value: 'role' },
                    { text: 'CDate', value: 'cdate' },
                    { text: 'MDate', value: 'mdate' }
                ],
            };
        },
        created () {
            this.$store.dispatch('partner/fetchPartners');
        },
        computed: {
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
            partners () {
                return this.$store.getters['partner/partners'];
            },
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