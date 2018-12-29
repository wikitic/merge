<template>
    <div>
        <div class="row col">
            <h1>Login</h1>
        </div>

        <div class="row col">
            <form>
                <div class="form-row">
                    <div class="col-4">
                        <input v-model="username" type="text" class="form-control">
                    </div>
                    <div class="col-4">
                        <input v-model="password" type="password" class="form-control">
                    </div>
                    <div class="col-4">
                        <button @click="performLogin()" :disabled="username.length === 0 || password.length === 0 || isLoading" type="button" class="btn btn-primary">Login</button>
                    </div>
                </div>
            </form>
        </div>

        <div v-if="isLoading" class="row col">
            <p>Loading...</p>
        </div>

        <div v-else-if="hasError" class="row col">
            <error-message :error="error"></error-message>
        </div>
    </div>
</template>

<script>
    import ErrorMessage from '../components/ErrorMessage';

    export default {
        name: 'login',
        components: {
            ErrorMessage,
        },
        data () {
            return {
                username: '',
                password: '',
            };
        },
        created () {
            let redirect = this.$route.query.redirect;

            if (this.$store.getters['security/isAuthenticated']) {
                if (typeof redirect !== 'undefined') {
                    this.$router.push({path: redirect});
                } else {
                    this.$router.push({path: '/home'});
                }
            }
        },
        computed: {
            isLoading () {
                return this.$store.getters['security/isLoading'];
            },
            hasError () {
                return this.$store.getters['security/hasError'];
            },
            error () {
                return this.$store.getters['security/error'];
            },
        },
        methods: {
            performLogin () {
                let payload = { username: this.$data.username, password: this.$data.password },
                    redirect = this.$route.query.redirect;

                this.$store.dispatch('security/login', payload)
                    .then(() => {
                        if (typeof redirect !== 'undefined') {
                            this.$router.push({path: redirect});
                        } else {
                            this.$router.push({path: '/home'});
                        }
                    });
            },
        },
    }
</script>

<style lang="scss" scoped>
    $color: #ff0000;
    h1 {
        color: $color;
        font-size: 100px !important;
    }
</style>