<template>
    <div>
        <subscription-view :subscription="event" />

        <full-calendar :events="subscriptions" :config="config" @event-selected="eventSelected($event)" />
    </div>
</template>

<script>
    import SubscriptionView from './Dialogs/SubscriptionView'

    export default {
        name: 'calendar',
        components: {
            SubscriptionView
        },
        data: () => ({
            event: null,
            config: {
                locale: 'es',
                defaultView: 'month'
            }
        }),
        created () {
            this.$store.dispatch('subscription/getSubscriptions')
        },
        computed: {
            subscriptions () {
                let subscriptions = this.$store.getters['subscription/subscriptions']
                let inDate = subscriptions.map(subscription => {
                    return {
                        subscription: subscription,
                        title: subscription.partner.fullname,
                        start: subscription.inDate,
                        className: 'inDate',
                        allDay : true
                    }
                })
                let outDate = subscriptions.map(subscription => {
                    return {
                        subscription: subscription,
                        title: subscription.partner.fullname,
                        start: subscription.outDate,
                        className: 'outDate',
                        allDay : true
                    }
                })

                return inDate.concat(outDate)
            }
        },
        methods: {
            eventSelected (event) {
                this.event = event.subscription;
            }
        }
    }
</script>



<style lang="scss">
    .fc-event {
        .fc-time {
            display: none
        }
    }
    .fc-event.inDate {
        background: #4CAF50;
        border-color: #4CAF50;
    }
    .fc-event.outDate {
        background: #F44336;
        border-color: #F44336;
    }
</style>