<template>
    <v-container fluid>
        <v-layout row wrap>
            <v-flex d-flex xs12>
                <calendar></calendar>
            </v-flex>
        </v-layout>
    </v-container>
</template>



<script>
    import Calendar from '../components/Calendar'

    export default {
        name: 'home',
        components: {
            Calendar
        },
        data: () => ({
        })
    }
</script>