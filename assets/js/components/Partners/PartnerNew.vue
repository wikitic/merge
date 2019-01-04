<template>
    <v-dialog v-model="dialog" persistent max-width="600px">
        <v-btn slot="activator" color="primary">Nuevo</v-btn>

        <v-card>
            <v-toolbar color="orange darken-2" dark>
                <v-toolbar-title>Nuevo Socio</v-toolbar-title>
            </v-toolbar>
            <v-card-text>
                <form @submit.prevent="submit">
                    <v-container grid-list-md>
                        <alert v-if="hasError" :error="error"></alert>
                        <v-layout wrap>
                            <v-flex xs12>
                                <v-text-field label="Nombre *" v-model="partner.name" :error-messages="nameErrors"></v-text-field>
                            </v-flex>
                            <v-flex xs12>
                                <v-text-field label="Apellidos *" v-model="partner.surname" :error-messages="surnameErrors"></v-text-field>
                            </v-flex>
                            <v-flex xs12>
                                <v-text-field label="Email *" v-model="partner.email" :error-messages="emailErrors"></v-text-field>
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
    import { required, maxLength, email } from 'vuelidate/lib/validators'
    import Alert from '../Alert'

    export default {
        name: 'partner-new',
        components: {
            Alert
        },
        mixins: [validationMixin],
        validations: {
            partner: {
                name: { required },
                surname: { required },
                email: { required, email }
            }
        },
        data: () => ({
            dialog: false,
            error: null,
            partner: {
                name: '',
                surname: '',
                email: ''
            }
        }),
        computed: {
            nameErrors () {
                const errors = []
                if (!this.$v.partner.name.$dirty) return errors
                !this.$v.partner.name.required && errors.push('El nombre es requerido')
                return errors
            },
            surnameErrors () {
                const errors = []
                if (!this.$v.partner.surname.$dirty) return errors
                !this.$v.partner.surname.required && errors.push('El apellido es requerido')
                return errors
            },
            emailErrors () {
                const errors = []
                if (!this.$v.partner.email.$dirty) return errors
                !this.$v.partner.email.email && errors.push('El email no es válido')
                !this.$v.partner.email.required && errors.push('El email es requerido')
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
                    this.$store.dispatch('partner/postPartners', this.partner)
                        .then(() => { this.dialog = false })
                        .catch(error => this.error = error.response )
                }
            }
        }
    }
</script>