<template>
    <v-dialog v-model="dialog" persistent max-width="600px">
        <v-btn slot="activator" color="primary">Nuevo socio</v-btn>

        <v-toolbar dark color="orange darken-2">
            <v-toolbar-title>
                <v-icon>person</v-icon>
                Nuevo socio
            </v-toolbar-title>
        </v-toolbar>
        <v-card>
            <v-card-text>
                <form @submit.prevent="submit">
                    <v-container grid-list-md>
                        <alert v-if="hasError" :error="error"></alert>
                        <v-layout wrap>
                            <v-flex xs6>
                                <v-select v-model="partner.active" item-text="text" item-value="value" :items="active" label="Estatus *" prepend-icon="visibility"></v-select>
                            </v-flex>
                            <v-flex xs6>
                                <v-select v-model="partner.role" item-text="text" item-value="value" :items="role" label="Rol *" prepend-icon="info"></v-select>
                            </v-flex>
                            <v-flex xs12>
                                <v-text-field v-model="partner.name" :error-messages="nameErrors" label="Nombre *" prepend-icon="person"></v-text-field>
                            </v-flex>
                            <v-flex xs12>
                                <v-text-field v-model="partner.surname" :error-messages="surnameErrors" label="Apellidos *" prepend-icon="person"></v-text-field>
                            </v-flex>
                            <v-flex xs12>
                                <v-text-field v-model="partner.email" :error-messages="emailErrors" label="Email *" prepend-icon="email"></v-text-field>
                            </v-flex>
                        </v-layout>
                    </v-container>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="darken-1" flat @click="dialog = false">Cerrar</v-btn>
                        <v-btn type="submit" :disabled="btnDisabled" color="primary">Guardar</v-btn>
                    </v-card-actions>
                </form>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>



<script>
    import { required, email } from 'vuelidate/lib/validators'

    export default {
        name: 'partner-new',
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
                email: '',
                active: { value: 1, text: 'Activado' },
                role: { value: 1, text: 'Premium' }
            },
            active: [ 
                { value: 0, text: 'Desactivado' },
                { value: 1, text: 'Activado' }
            ],
            role: [
                { value: 0, text: 'Usuario' },
                { value: 1, text: 'Premium' }
            ]
        }),
        computed: {
            btnDisabled () {
                return this.partner.name === '' || this.partner.surname === '' || this.partner.email === ''
            },
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
                !this.$v.partner.email.required && errors.push('El email es requerido')
                !this.$v.partner.email.email && errors.push('El email no es válido')
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
                    this.partner.active = this.partner.active.value
                    this.partner.role = this.partner.role.value

                    this.$store.dispatch('partner/postPartners', this.partner)
                        .then(() => { this.dialog = false })
                        .catch(error => this.error = error.response )
                }
            }
        }
    }
</script>