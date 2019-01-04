<template>
    <v-dialog v-model="dialog" persistent max-width="600px">
        <v-btn slot="activator" flat icon color="grey">
            <v-icon>edit</v-icon>
        </v-btn>

        <v-card>
            <v-card-title>
                <span class="headline">Suscripción</span>
            </v-card-title>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout wrap>
                        <v-flex xs12>
                            <v-text-field label="Info" v-model="subscription.info" required></v-text-field>
                        </v-flex>
                        <v-flex xs12>
                            <v-text-field label="Price" v-model="subscription.price" required></v-text-field>
                        </v-flex>
                        <v-flex xs12>
                            <v-text-field label="Alta" v-model="subscription.inDate" required></v-text-field>
                        </v-flex>
                        <v-flex xs12>
                            <v-text-field label="Baja" v-model="subscription.outDate" required></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-container>
                <small>* Campos obligatorios</small>
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
        name: 'subscription-edit',
        props: ['subscription'],
        data () {
            return {
                dialog: false
            }
        },
        methods: {
            save () {
                console.log(this.subscription.info)
                //this.$store.dispatch('partner/patchPartners', this.partner)
                    //.then(() => dialog = false)
           }
        }
    }
</script>