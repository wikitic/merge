<template>
    <v-dialog v-model="dialog" persistent max-width="600px">
        <v-btn slot="activator" flat icon color="grey">
            <v-icon>delete</v-icon>
        </v-btn>

        <v-card>
            <v-toolbar color="orange darken-2" dark>
                <v-toolbar-title>Borrar Suscripción</v-toolbar-title>
            </v-toolbar>
            <v-card-text>
                <form @submit.prevent="submit">
                    <v-container grid-list-md>
                        <v-layout wrap>
                            <v-flex xs12>
                                <v-text-field label="Código aleatorio" v-model="confirm.random" disabled></v-text-field>
                            </v-flex>
                            <v-flex xs12>
                                <v-text-field label="Confirma código *" v-model="confirm.code" required maxlength="6" counter="6"></v-text-field>
                            </v-flex>
                        </v-layout>
                    </v-container>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn flat @click="dialog = false">Cerrar</v-btn>
                        <v-btn type="submit" :disabled="isDisabled" color="primary">Borrar</v-btn>
                    </v-card-actions>
                </form>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>


<script>
    export default {
        name: 'subscriptions-delete',
        props: ['subscription'],
        data: () => ({
            dialog: false,
            confirm: {
                random: Math.random().toString(36).substring(2, 8).toUpperCase(),
                code: ''
            }
        }),
        computed: {
            isDisabled () {
                return this.confirm.random !== this.confirm.code
            }
        },
        methods: {
            submit () {
                /*
                this.$store.dispatch('subscription/deleteSubscriptions', this.subscription)
                    .then(() => { this.dialog = false })
                    */
            }
        }
    }
</script>