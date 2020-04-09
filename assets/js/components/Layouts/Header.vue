<template>
</template>

<script>
    export default {
        name: 'Header',
        props: {
            meta: {
                type: Object,
                default: null
            }
        },
        metaInfo () {
            return {
                links: [
                    {rel: 'canonical', href: ''}
                ],
                title: this.meta.title,
                meta: [
                    {name: 'keywords', content: ''},
                    {name: 'description', content: ''},
                    // Google
                    {itemprop: 'url', content: ''},
                    {itemprop: 'name', content: ''},
                    {itemprop: 'description', content: '.'},
                    {itemprop: 'image', content: ''},
                    // facebook
                    {property: 'og:locale', content: 'es_ES'},
                    {property: 'og:title', content: ''},
                    {property: 'og:site_name', content: ''},
                    {property: 'og:type', content: ''},
                    {property: 'og:url', content: ''},
                    {property: 'og:image', content: ''},
                    {property: 'og:description', content: ''},
                    // twitter
                    {name: 'twitter:domain', content: ''},
                    {name: 'twitter:url', content: ''},
                    {name: 'twitter:card', content: 'summary_large_image'},
                    {name: 'twitter:site', content: ''},
                    {name: 'twitter:title', content: ''},
                    {name: 'twitter:description', content: ''},
                    {name: 'twitter:image', content: ''},
                    {name: 'twitter:creator', content: ''},
                    {name: 'twitter:image:src', content: ''},
                ]
            }
        }
    }
</script>
