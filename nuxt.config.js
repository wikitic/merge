import exercises from './static/exercises.json'

const canonical = 'https://wikitic.github.io'
const title = 'Wiki TIC'
const description = 'Ejercicios prácticos aplicados a las TIC en educación'
const routerBase = {
  router: {
    base: process.env.DEPLOY_ENV === 'MASTER' ? '/' : '/'
  }
}

export default {
  mode: 'universal',

  ...routerBase,
  env: {
    canonical: canonical,
    title: title,
    description: description
  },

  /*
  ** Headers of the page
  */
  head: {
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { name: 'robots', content: 'index, follow' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' },
      {
        rel: 'stylesheet',
        href:
          'https://fonts.googleapis.com/css?family=Noto+Serif+JP:200,300,400,500,700,900'
      },
      {
        rel: 'stylesheet',
        href: 'https://use.fontawesome.com/releases/v5.7.2/css/all.css',
        integrity:
          'sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr',
        crossorigin: 'anonymous'
      }
    ]
  },

  /*
  ** Customize the progress-bar color
  */
  loading: {
    color: '#2d2d2d',
    height: '3px'
  },

  /*
  ** Global CSS
  */
  css: ['~/assets/style/bootstrap.scss', '~/assets/style/custom.scss'],

  /*
  ** Plugins to load before mounting the App
  */
  plugins: [{ src: '~plugins/ga.js', ssr: false }],

  /*
  ** Nuxt.js modules
  */
  modules: [
    // Doc: https://axios.nuxtjs.org/usage
    '@nuxtjs/axios',
    'bootstrap-vue/nuxt'
  ],
  /*
  ** Axios module configuration
  */
  axios: {
    // See https://github.com/nuxt-community/axios-module#options
  },
  bootstrapVue: {
    // See https://bootstrap-vue.js.org/docs
    bootstrapCSS: false, // or `css`
    bootstrapVueCSS: false // or `bvCSS`
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
  },

  /*
  ** generate
  */
  generate: {
    routes: async function() {
      const t = [
        '/tag/raspberry+pi',
        '/tag/raspbian',
        '/tag/noobs',
        '/tag/etcher',
        '/tag/update',
        '/tag/piclone',
        '/tag/ssh',
        '/tag/vnc',
        '/tag/ip',
        '/tag/webcam',
        '/tag/luvcview',
        '/tag/fswebcam',
        '/tag/cron',
        '/tag/motion',
        '/tag/microbit',
        '/tag/mu+editor',
        '/tag/micropython',
        '/tag/python',
        '/tag/nodemcu',
        '/tag/esp8266',
        '/tag/arduino+ide',
        '/tag/wifi',
        '/tag/pyserial',
        '/tag/gpio',
        '/tag/node+red',
        '/tag/webserver',
        '/tag/hotspot',
        '/tag/raspap'
      ]

      const e = await exercises.map(exercise => {
        return `/${exercise.alias}`
      })
      return Promise.all([t, e]).then(v => {
        return [...v[0], ...v[1]]
      })
    }
  }
}
