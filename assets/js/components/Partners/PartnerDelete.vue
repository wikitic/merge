<template>
    <v-dialog v-model="dialog" persistent max-width="600px">
        <v-btn v-if="hasSubscriptions" slot="activator" flat icon color="grey">
            <v-icon>delete</v-icon>
        </v-btn>
        <v-card>
            <v-card-title>
                <span class="headline">Borrar socio</span>
            </v-card-title>
            <v-card-text>
                <v-alert v-if="!isDisabled" :value="true" type="warning">
                    ¿Seguro que quieres borrar a <b>{{ partner.fullname }}</b>?
                </v-alert>
                <v-alert v-if="hasError" :value="true" color="error" icon="warning">
                    {{ error.response.status }} {{ error.response.statusText }}
                </v-alert>
                <v-container grid-list-md>
                    <v-layout wrap>
                        <v-flex xs12>
                            <v-text-field label="Código" v-model="partner.code" disabled></v-text-field>
                        </v-flex>
                        <v-flex xs12>
                            <v-text-field label="Confirma código*" v-model="confirm.code" required maxlength="6" counter="6"></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-container>
                <small>* Campos obligatorios</small>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="darken-1" flat @click="dialog = false">Cerrar</v-btn>
                <v-btn color="orange" :disabled="isDisabled" class="primary" @click="deletePartner()">Borrar</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>


<script>
    export default {
        name: 'partner-edit',
        props: ['partner'],
        data () {
            return {
                dialog: false,
                confirm: {
                    code: null
                }
            }
        },
        computed: {
            hasSubscriptions () {
                return this.partner.subscriptions.length === 0
            },
            isDisabled () {
                return this.partner.code !== this.confirm.code
            },
            hasError () {
                return this.$store.getters['partner/hasError'];
            },
            error () {
                return this.$store.getters['partner/error'];
            },
        },
        methods: {
            deletePartner () {
                this.$store.dispatch('partner/deletePartners', this.partner)
            }
        }
    }
</script>