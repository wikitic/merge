<template>
    <v-footer>
        <v-layout justify-center>
            &copy;{{ date }} — Made with &hearts; by&nbsp;<strong>Asociación Programo Ergo Sum</strong>
        </v-layout>
    </v-footer>
</template>



<script>
    export default {
        name: 'Footer',
        data: () => ({
            date: new Date().getFullYear()
        })
    }
</script>
