<template>
    <v-dialog v-model="dialog" persistent max-width="600px">
        <v-btn slot="activator" dark color="grey">Nueva suscripción</v-btn>

        <v-card>
            <v-toolbar color="orange darken-2" dark>
                <v-toolbar-title>Nueva suscripción</v-toolbar-title>
            </v-toolbar>
            <v-card-text>
                <form @submit.prevent="submit">
                    <v-container grid-list-md>
                        <alert v-if="hasError" :error="error"></alert>
                        <v-layout wrap>
                            <v-flex xs12>
                                <v-text-field prepend-icon="person" label="Socio" v-model="partner.code" disabled></v-text-field>
                            </v-flex>
                            <v-flex xs12 sm6 >
                                <v-menu v-model="calendar1" offset-y>
                                    <v-text-field prepend-icon="event" label="Inicio *" v-model="subscription.inDate" slot="activator" readonly></v-text-field>
                                    <v-date-picker v-model="subscription.inDate" no-title @input="calendar1 = false"></v-date-picker>
                                </v-menu>
                            </v-flex>
                            <v-flex xs12 sm6 >
                                <v-menu v-model="calendar2" offset-y>
                                    <v-text-field prepend-icon="event" label="Fin *" v-model="subscription.outDate" slot="activator" readonly></v-text-field>
                                    <v-date-picker v-model="subscription.outDate" no-title @input="calendar2 = false"></v-date-picker>
                                </v-menu>
                            </v-flex>
                            <v-flex xs12>
                                <v-text-field prepend-icon="info" label="Info *" v-model="subscription.info" :error-messages="infoErrors"></v-text-field>
                            </v-flex>
                            <v-flex xs12>
                                <v-text-field prepend-icon="euro_symbol" label="Price *" v-model="subscription.price" :error-messages="priceErrors"></v-text-field>
                            </v-flex>
                        </v-layout>
                    </v-container>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn flat @click="dialog = false">Cerrar</v-btn>
                        <v-btn type="submit" color="primary">Guardar</v-btn>
                    </v-card-actions>
                </form>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>



<script>
    import { validationMixin } from 'vuelidate'
    import { required, decimal } from 'vuelidate/lib/validators'

    export default {
        name: 'subscriptions-new',
        props: ['partner'],
        mixins: [validationMixin],
        validations: {
            subscription: {
                info: { required },
                price: { required, decimal }
            }
        },
        data: vm => ({
            dialog: false,
            calendar1: false,
            calendar2: false,
            error: null,
            subscription: {
                partner: null,
                inDate: new Date().toISOString().substr(0, 10),
                outDate: new Date(new Date().setFullYear(new Date().getFullYear() + 1)).toISOString().substr(0, 10),
                info: 'Suscripción anual',
                price: '29.99'
            }
        }),
        computed: {
            infoErrors () {
                const errors = []
                if (!this.$v.subscription.info.$dirty) return errors
                !this.$v.subscription.info.required && errors.push('La información es requerida')
                return errors
            },
            priceErrors () {
                const errors = []
                if (!this.$v.subscription.price.$dirty) return errors
                !this.$v.subscription.price.required && errors.push('El precio es requerido')
                !this.$v.subscription.price.decimal && errors.push('El precio no es válido')
                return errors
            },
            hasError () {
                return this.error !== null
            }
        },
        methods: {
            submit () {
                this.$v.$touch()
                if (!this.$v.$invalid) {
                    this.subscription.partner = this.partner
                    this.subscription.inDate = this.subscription.inDate+' 00:00:00'
                    this.subscription.outDate = this.subscription.outDate+' 00:00:00'
                    this.$store.dispatch('partner/postSubscriptions', this.subscription)
                        .then(() => { this.dialog = false })
                        .catch(error => this.error = error.response )
                }
           }
        }
    }
</script>