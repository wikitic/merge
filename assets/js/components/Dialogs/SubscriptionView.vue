<template>
    <v-dialog v-if="dialog" v-model="dialog" persistent max-width="600px">
        <v-card>
            <v-toolbar dark color="orange darken-2">
                <v-toolbar-title>
                    <v-icon>person</v-icon>
                    {{subscription.partner.fullname}}
                </v-toolbar-title>
            </v-toolbar>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout wrap>
                        <v-flex xs5>
                            <v-text-field v-bind:value="toDate(subscription.inDate)" label="Inicio" prepend-icon="event" disabled></v-text-field>
                        </v-flex>
                        <v-flex xs5>
                            <v-text-field v-bind:value="toDate(subscription.outDate)" label="Fin" prepend-icon="event" disabled></v-text-field>
                        </v-flex>
                        <v-flex xs2>
                            <v-icon v-if="isSubscriber()" x-large right color="green">done</v-icon>
                            <v-icon v-else x-large right color="red">clear</v-icon>
                        </v-flex>
                        <v-flex xs12>
                            <v-text-field v-model="subscription.info" label="Info" prepend-icon="info" disabled></v-text-field>
                        </v-flex>
                        <v-flex xs12>
                            <v-text-field v-model="subscription.price" label="Price" prepend-icon="euro_symbol" disabled></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="darken-1" flat @click="dialog = false">Cerrar</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
    export default {
        name: 'subscription-view',
        props: {
            subscription: {
                type: Object,
                default: null
            }
        },
        data: () => ({
            dialog: false
        }),
        watch: {
            subscription: function (val) {
                if (val !== null)
                    this.dialog = true
            }
        },
        methods: {
            toDate (datetime) {
                let date = new Date(datetime)
                return date.toLocaleDateString("es-ES") //eu-ES
            },
            isSubscriber () {
                let now = new Date()
                let inDate = new Date(this.subscription.inDate)
                let outDate = new Date(this.subscription.outDate)

                if(now > inDate && now < outDate)
                    return 1
                else
                    return 0
            }
        }
    }
</script>