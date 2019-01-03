<template>
    <v-dialog v-model="dialog" persistent max-width="600px">
        <v-btn slot="activator" flat icon color="grey">
            <v-icon>delete</v-icon>
        </v-btn>
        <v-card>
            <v-card-title>
                <span class="headline">Borrar socio</span>
            </v-card-title>
            <v-card-text>
                <v-alert :value="true" type="warning">¿Seguro que quieres borrar a <b>{{ partner.fullname }}</b>?</v-alert>
                <v-container grid-list-md>
                    <v-layout wrap>
                        <v-flex xs12>
                            <v-text-field label="Código" v-model="partner.code" disabled></v-text-field>
                        </v-flex>
                        <v-flex xs12>
                            <v-text-field label="Confirma código*" v-model="confirm.code" required></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-container>
                <small>* Campos obligatorios</small>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="darken-1" flat @click="dialog = false">Cerrar</v-btn>
                <v-btn color="orange" flat @click="deletePartner()">Borrar</v-btn>
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
        methods: {
            deletePartner () {
                alert(this.partner.code === this.confirm.code)
                    
                //console.log(this.partner.name)
                //this.$store.dispatch('partner/patchPartners', this.partner)
                    //.then(() => dialog = false)
           }
        }
    }
</script>