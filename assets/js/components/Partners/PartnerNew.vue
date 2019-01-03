<template>
    <v-dialog v-model="dialog" persistent max-width="600px">
        <v-btn slot="activator" color="primary">Nuevo</v-btn>

        <v-card>
            <v-card-title>
                <span class="headline">Socio</span>
            </v-card-title>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout wrap>
                        <v-flex xs12>
                            <v-text-field label="Código" v-model="partner.code" disabled></v-text-field>
                        </v-flex>
                        <v-flex xs12>
                            <v-text-field label="Nombre*" v-model="partner.name" required></v-text-field>
                        </v-flex>
                        <v-flex xs12>
                            <v-text-field label="Apellidos*" v-model="partner.surname" required></v-text-field>
                        </v-flex>
                        <v-flex xs12>
                            <v-text-field label="Email*" v-model="partner.email" required></v-text-field>
                        </v-flex>
                        <!--
                        <v-flex xs12 sm6>
                            <v-select :options="role" :value="partner.role" label="Rol*" required></v-select>
                        </v-flex>
                        <v-flex xs12 sm6>
                            <v-select :items="status" v-model="partner.status" label="Estado*" required></v-select>
                        </v-flex>
                        -->
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
    name: 'partner-new',
    data () {
      return {
        dialog: false,
        partner: {
        }
      }
    },
    methods: {
      save () {
        alert('save')
        //console.log(this.partner.name)
        //this.$store.dispatch('partner/patchPartners', this.partner)
            //.then(() => dialog = false)
      }
    }
  }
</script>