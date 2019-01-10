<template>
    <v-dialog v-model="dialog" persistent max-width="600px">
        <v-btn slot="activator" flat icon color="grey">
            <v-icon>edit</v-icon>
        </v-btn>

        <v-toolbar dark color="orange darken-2">
            <v-toolbar-title>
                <v-icon>person</v-icon>
                {{subscription.partner.fullname}}
            </v-toolbar-title>
        </v-toolbar>
        <v-card>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout wrap>
                        <v-flex xs5>
                            <v-text-field v-bind:value="toDate(subscription.inDate)" label="Inicio" prepend-icon="event"></v-text-field>
                        </v-flex>
                        <v-flex xs5>
                            <v-text-field v-bind:value="toDate(subscription.outDate)" label="Fin" prepend-icon="event"></v-text-field>
                        </v-flex>
                        <v-flex xs12>
                            <v-text-field v-model="subscription.info" label="Info" prepend-icon="info"></v-text-field>
                        </v-flex>
                        <v-flex xs12>
                            <v-text-field v-model="subscription.price" label="Price" prepend-icon="euro_symbol"></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="darken-1" flat @click="dialog = false">Cerrar</v-btn>
                <v-btn color="orange" flat @click="save()">Guardar</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>


<script>
    export default {
        name: 'subscriptions-edit',
        props: {
            subscription: {
                type: Object,
                default: null
            }
        },
        data: () => ({
            dialog: false
        }),
        methods: {
            toDate (datetime) {
                let date = new Date(datetime)
                return date.toLocaleDateString("es-ES") //eu-ES
            },
            save () {
                console.log(this.subscription.info)
                //this.$store.dispatch('partner/patchPartners', this.partner)
                    //.then(() => dialog = false)
           }
        }
    }
</script>