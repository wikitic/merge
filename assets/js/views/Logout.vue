<template>
    <v-container fluid>
        Logout
    </v-container>
</template>

<script>
    export default {
        name: 'logout',
        created () {
            this.$store.dispatch('security/logout');

            this.$router.push({path: '/'});
        }
    }
</script>

<style lang="scss" scoped>

</style>