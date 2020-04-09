<template>
    <v-container grid-list-xl fluid>

        <v-card class="mb-4">
            <v-card-text>
                <v-layout wrap>
                    <v-flex xs6>
                        <v-layout wrap>
                            <v-flex xs12>
                                <v-text-field v-model="partner.code" label="Código" prepend-icon="person" disabled></v-text-field>
                            </v-flex>
                            <v-flex xs12>
                                <v-text-field v-model="partner.email" label="Email" prepend-icon="email" disabled></v-text-field>
                            </v-flex>
                            <v-flex xs12>
                                <v-text-field v-model="partner.name" label="Nombre" prepend-icon="person" disabled></v-text-field>
                            </v-flex>
                            <v-flex xs12>
                                <v-text-field v-model="partner.surname" label="Apellidos" prepend-icon="person" disabled></v-text-field>
                            </v-flex>
                        </v-layout>
                    </v-flex>

                    <v-flex xs6>
                        <v-layout wrap>
                            <v-flex xs6>
                                <v-text-field v-model="partner.active" label="Estado" prepend-icon="visibility" disabled></v-text-field>
                            </v-flex>
                            <v-flex xs6>
                                <v-text-field v-model="partner.role" label="Rol" prepend-icon="info" disabled></v-text-field>
                            </v-flex>
                            <v-flex xs6>
                                <v-text-field v-model="partner.cdate" label="Registrado" prepend-icon="calendar" disabled></v-text-field>
                            </v-flex>
                            <v-flex xs6>
                                <v-text-field v-model="partner.mdate" label="Modificado" prepend-icon="calendar" disabled></v-text-field>
                            </v-flex>
                        </v-layout>
                    </v-flex>
                </v-layout>
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