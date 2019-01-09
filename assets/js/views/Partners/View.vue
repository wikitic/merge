<template>
    <v-container grid-list-xl fluid>

        <v-toolbar color="orange darken-2" dark>
            <v-toolbar-title>{{partner.fullname}}</v-toolbar-title>
        </v-toolbar>
        <v-card>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout wrap>
                        <v-flex xs4>
                            <v-text-field v-model="partner.name" label="Nombre" prepend-icon="person" disabled></v-text-field>
                        </v-flex>
                        <v-flex xs4>
                            <v-text-field v-model="partner.surname" label="Apellidos" prepend-icon="person" disabled></v-text-field>
                        </v-flex>
                        <v-flex xs4>
                            <v-text-field v-model="partner.email" label="Email" prepend-icon="email" disabled></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card-text>
        </v-card>

        <v-card>
            <!--
            <v-toolbar flat color="white">
                <v-toolbar-title>Socios</v-toolbar-title>
                <v-spacer></v-spacer>
                <partners-new></partners-new>
            </v-toolbar>
            -->
            <v-card-text>
                <subscriptions-list :subscriptions="partner.subscriptions"></subscriptions-list>
            </v-card-text>
        </v-card>

    </v-container>
</template>

<script>
    import SubscriptionsList from '../../components/Tables/SubscriptionsList'

    export default {
        name: 'partners-view',
        components: {
            /*
            PartnersNew,
            PartnersEdit,
            PartnersDelete,
            */
            SubscriptionsList
        },
        data: () => ({
            
        }),
        created () {
            this.$store.dispatch('partner/getPartners')
        },
        computed: {
            partners () {
                return this.$store.getters['partner/partners'];
            },
            partner () {
                return this.partners.find(partner => partner.id === Number(this.$route.params.idPartner));
            }
        }
    }
</script>