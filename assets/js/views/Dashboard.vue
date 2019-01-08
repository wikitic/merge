<template>
    <v-container fluid>
        <v-card>
            <v-toolbar flat color="white">
                <v-toolbar-title>Socios</v-toolbar-title>
                <v-spacer></v-spacer>
                <partner-new></partner-new>
            </v-toolbar>
            <v-card-title>
                <h3>Socios</h3>
            </v-card-title>
            <v-card-text>
                <v-sparkline :labels="labels" :value="value" color="black" line-width="0.5" padding="20" ></v-sparkline>
            </v-card-text>
        </v-card>
    </v-container>
</template>

<script>
    export default {
        name: 'dashboard',
        data: () => ({
      labels: [
        'Enero',
        'Febrero',
        'Marzo',
        'Abril',
        'Mayo',
        'Junio',
        'Julio',
        'Agosto',
        'Septiembre',
        'Octubre',
        'Noviembre',
        'Diciembre'
      ],
      value: [
        9,4,4,7,9,1,9,14,7,10,14,6
      ]
    })
    }
</script>