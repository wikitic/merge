<template>
    <v-alert :value="true" color="error" icon="warning">
        {{ error.response.data.error }}
    </v-alert>
</template>

<script>
    export default {
        name: 'errorMessage',
        props: ['error'],
    }
</script>



