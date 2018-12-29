<template>
    <div>
        <div class="row col">
            <h1>Partners</h1>
        </div>
        <!--
        <div class="row col">
            <form>
                <div class="form-row">
                    <div class="col-8">
                        <input v-model="message" type="text" class="form-control">
                    </div>
                    <div class="col-4">
                        <button @click="createPost()" :disabled="message.length === 0 || isLoading" type="button" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </form>
        </div>
        -->

        <div v-if="isLoading" class="row col">
            <p>Loading...</p>
        </div>

        <div v-else-if="hasError" class="row col">
            <div class="alert alert-danger" role="alert">
                {{ error }}
            </div>
        </div>

        <div v-else-if="!hasPartners" class="row col">
            No partners!
        </div>

        <div v-else v-for="partner in partners" :key="partner.id" class="row col">
            <partner :name="partner.name"></partner>
        </div>
    </div>
</template>

<script>
    import Partner from '../components/Partner';

    export default {
        name: 'partners',
        components: {
            Partner
        },
        data () {
            return {
                name: '',
            };
        },
        created () {
            this.$store.dispatch('partner/fetchPartners');
        },
        computed: {
            isLoading () {
                return this.$store.getters['partner/isLoading'];
            },
            hasError () {
                return this.$store.getters['partner/hasError'];
            },
            error () {
                return this.$store.getters['partner/error'];
            },
            hasPartners () {
                return this.$store.getters['partner/hasPartners'];
            },
            partners () {
                return this.$store.getters['partner/partners'];
            },
        },
        /*
        methods: {
            createPost () {
                this.$store.dispatch('post/createPost', this.$data.message)
                    .then(() => this.$data.message = '')
            },
        },
        */
    }
</script>