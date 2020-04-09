<template>
    <v-dialog v-model="dialog" persistent max-width="600px">
        <v-btn v-if="!hasSubscriptions" slot="activator" flat icon color="grey">
            <v-icon>delete</v-icon>
        </v-btn>
        
        <v-card>
            <v-toolbar dark color="orange darken-2">
                <v-toolbar-title>
                    <v-icon>person</v-icon>
                    {{partner.fullname}}
                </v-toolbar-title>
            </v-toolbar>
            <v-card-text>
                <form @submit.prevent="submit">
                    <v-container grid-list-md>
                        <v-layout wrap>
                            <v-flex xs12>
                                <v-text-field v-model="confirm.random" label="Código" prepend-icon="person" disabled></v-text-field>
                            </v-flex>
                            <v-flex xs12>
                                <v-text-field v-model="confirm.code" label="Confirma código *" prepend-icon="person" required maxlength="6" counter="6"></v-text-field>
                            </v-flex>
                        </v-layout>
                    </v-container>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="darken-1" flat @click="dialog = false">Cerrar</v-btn>
                        <v-btn type="submit" :disabled="btnDisabled" color="primary">Borrar</v-btn>
                    </v-card-actions>
                </form>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>



<script>
    export default {
        name: 'partner-edit',
        props: {
            partner: {
                type: Object,
                default: null
            }
        },
        data: () => ({
            dialog: false,
            confirm: {
                random: Math.random().toString(36).substring(2, 8).toUpperCase(),
                code: ''
            }
        }),
        computed: {
            hasSubscriptions () {
                return this.partner.numSubscriptions > 0
            },
            btnDisabled () {
                return this.confirm.random !== this.confirm.code
            }
        },
        methods: {
            submit () {
                this.$store.dispatch('partner/deletePartners', this.partner)
                    .then(() => { this.dialog = false })
            }
        }
    }
</script>