<template>
    <full-calendar :events="subscriptions" :config="config"/>
</template>

<script>
    export default {
        name: 'calendar',
        data: () => ({
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
                            title: subscription.partner.fullname,
                            start: subscription.inDate,
                            className: 'inDate',
                            allDay : true
                        }
                    })
                let outDate = subscriptions.map(subscription => {
                    return {
                        title: subscription.partner.fullname,
                        start: subscription.outDate,
                        className: 'outDate',
                        allDay : true
                    }
                })

                return inDate.concat(outDate)
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