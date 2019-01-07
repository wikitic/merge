<template>
    <v-container fluid>
        <v-card>
            <v-toolbar flat color="white">
                <v-toolbar-title>Socios</v-toolbar-title>
                <v-spacer></v-spacer>
                <partner-new></partner-new>
            </v-toolbar>
            <v-card-title>
                <h3>Suscripciones</h3>
            </v-card-title>
            <v-card-text>
                <v-expansion-panel focusable>
                    <v-expansion-panel-content v-for="(item,i) in 5" :key="i">
                        <div slot="header">Item</div>
                        <v-card>
                            <v-card-text class="grey lighten-3">
                                Lorem ipsum dolor minim ex ea commodo consequat.
                            </v-card-text>
                        </v-card>
                    </v-expansion-panel-content>
                </v-expansion-panel>
            </v-card-text>
        </v-card>

    </v-container>
</template>

<script>
    /*
    import PartnerNew from '../components/Partners/PartnerNew'
    import PartnerEdit from '../components/Partners/PartnerEdit'
    import PartnerDelete from '../components/Partners/PartnerDelete'
    import Subscriptions from '../components/Partners/Subscriptions'
    */

    export default {
        name: 'subscriptions',
        /*
        components: {
            PartnerNew,
            PartnerEdit,
            PartnerDelete,
            Subscriptions
        },
        */
        data () {
            return {
                
            };
        },
        /*
        created () {
            this.$store.dispatch('partner/getPartners')
        },
        computed: {
            partners () {
                return this.$store.getters['partner/partners']
            }
        },
        */
        methods: {
            /*
            toDate (datetime) {
                let date = new Date(datetime)
                return date.toLocaleDateString("es-ES") //eu-ES
            },
            getAlta (subscriptions) {
                let subs = subscriptions[subscriptions.length-1]
                
                if(subs === undefined)
                    return null
                
                return this.toDate(new Date(subs.inDate))

            },
            getBaja (subscriptions) {
                let subs = subscriptions[0]
                
                if(subs === undefined)
                    return null
                
                return this.toDate(new Date(subs.outDate))

            },
            getStatus (subscriptions) {
                let now = new Date()
                let inDate, outDate
                let first = subscriptions[0]
                let last = subscriptions[subscriptions.length-1]

                if(first === undefined || last === undefined)
                    return 0

                inDate = new Date(first.inDate)
                outDate = new Date(first.outDate)

                if(now > inDate && now < outDate)
                    return 1
                else
                    return 0
            },
            getColorByStatus (subscriptions) {
                return this.colors[this.getStatus(subscriptions)]
            }
            */
        }
    }
</script>