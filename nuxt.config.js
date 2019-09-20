const www =
  process.env.NODE_ENV === 'development'
    ? 'http://localhost:3000'
    : 'https://wikitic.github.io'
const cdn =
  process.env.NODE_ENV === 'development'
    ? 'http://localhost:3000'
    : 'https://wikitic.github.io'

export default {
  mode: 'universal',

  router: {
    base: '/'
  },
  env: {
    www,
    cdn
  },

  /*
   ** Headers of the page
   */
  head: {
    htmlAttrs: {
      lang: 'es'
    },
    meta: [
      { charset: 'utf-8' },
      { hreflang: 'es' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'robots', name: 'robots', content: 'index, follow' },
      {
        name: 'google-site-verification',
        content: 'Q62Pt4_HTSBH5qBIawSbbtoyC0o_AAz4Q4DlpCMMtco'
      }
    ],
    link: [
      { hreflang: 'es' },
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },

  /*
   ** Customize the progress-bar color
   */
  loading: { color: '#2d2d2d' },

  /*
   ** Global CSS
   */
  css: ['~/assets/style/main.scss'],

  /*
   ** Plugins to load before mounting the App
   */
  plugins: [{ src: '~plugins/ga.js', ssr: false }],

  buildModules: [
    // Simple usage
    '@nuxtjs/eslint-module',
    // Doc: https://github.com/nuxt-community/vuetify-module/
    '@nuxtjs/vuetify'
  ],
  vuetify: {
    theme: {
      light: true,
      themes: {
        light: {
          primary: '#2d2d2d',
          secondary: '#101a24'
        }
      }
    }
  },
  /*
   ** Nuxt.js modules
   */
  modules: [
    // Doc: https://axios.nuxtjs.org/usage
    '@nuxtjs/axios'
  ],
  /*
   ** Axios module configuration
   */
  axios: {
    // See https://github.com/nuxt-community/axios-module#options
  },

  /*
   ** Generate
   */
  generate: {
    routes() {
      const p = ['/', '/404']
      return Promise.all([p]).then(v => {
        return [...v[0]]
      })
    }
  },

  /*
   ** Build configuration
   */
  build: {
    /*
     ** You can extend webpack config here
     */
    extend(config, ctx) {
      // Run ESLint on save
      if (ctx.isDev && ctx.isClient) {
        config.module.rules.push({
          enforce: 'pre',
          test: /\.(js|vue)$/,
          loader: 'eslint-loader',
          exclude: /(node_modules)/
        })
      }
    }
  }
}
