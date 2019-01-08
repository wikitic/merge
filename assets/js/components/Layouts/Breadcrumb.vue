<template>
    <v-breadcrumbs :items="items" divider=">" class="breadcrumbs">
        <template slot="item" slot-scope="props">
            <router-link :to="{ name: props.item.href }">
                {{ props.item.name }}
            </router-link>
        </template>
    </v-breadcrumbs>
</template>



<script>
    export default {
        name: 'Breadcrumb',
        data: () => ({
            items: []
        }),
        watch: {
            '$route' () {
                this.items = this.$route.meta.breadcrumb
            }
        }
    }
</script>



<style lang="scss" scoped>
    .breadcrumbs {
        a {
            text-decoration: none;
        }
    }
</style>