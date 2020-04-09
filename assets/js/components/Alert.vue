<template>
    <v-alert :value="true" v-bind:type="getType" outline>
        <b>{{ error.status }} {{ error.statusText }}</b>:
        <ul v-for="er in error.data" :key="er.message">
            <li>{{er.message}}</li>
        </ul>
    </v-alert>
</template>

<script>
    export default {
        name: 'alert',
        props: ['error'],
        data: () => ({
            type: null
        }),
        computed: {
            getType () {
                switch (this.error.status) {
                    case 200:
                        return 'success'
                        break;
                    case 300:
                        return 'warning'
                        break;
                    case 400:
                        return 'error'
                        break;
                    default:
                        return 'info'
                }
            }
        }
    }
</script>



