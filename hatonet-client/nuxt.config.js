const envServer = require(`./env/env.${process.env.NODE_ENV}.js`)

export default {
  loading: false,
  ssr: true,
  head: {
    title: 'Hatonet',
    htmlAttrs: {
      lang: 'vi',
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' },
      { name: 'format-detection', content: 'telephone=no' },
    ],
    link: [{ rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }],
  },

  css: [
    '~/assets/scss/fonts.scss',
    '~/assets/scss/admin.scss',
    '~/assets/libs/icons/tabler-icons.css',
    '~/assets/scss/client.scss',
  ],
  components: true,

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
    { src: '~/plugins/paginate.js', mode: 'client' },
    { src: '~/plugins/step.js', mode: 'client' },
    { src: '~/plugins/select-tree.js', mode: 'client' },
    { src: '~/plugins/axios.js', mode: 'client' },
    { src: '~/plugins/draggable.js', mode: 'client' },
    { src: '~/plugins/mixError.js', mode: 'client' },
    { src: '~/plugins/select.js', mode: 'client' },
    { src: '~/plugins/vue-multiselect.js', mode: 'client' },
    { src: '~/plugins/vue-rating.client.js', mode: 'client' },
    { src: '~/plugins/flatpickr.js', mode: 'client' },
    { src: '~/plugins/vee-validate.js', mode: 'client' },
    // { src: '~/plugins/text-editor.js', mode: 'client' },
    { src: '~/static/js/bootstrap.bundle.min.js', mode: 'client' },
    // { src: '~/plugins/vue-slick.js', mode: 'client' },
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  modules: [
    '@nuxtjs/axios',
    '@nuxtjs/auth-next',
    'cookie-universal-nuxt',
    '@nuxtjs/toast',
    '@nuxtjs/moment',
    'vue2-editor/nuxt'
  ],

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
    postcss: null,
    transpile: ['vee-validate'],
  },
  axios: {
    baseURL: envServer.baseUrl,
    withCredentials: true,
  },
  //middleware: ['auth'],
  auth: {
    localStorage: false,
    local: false,
    strategies: {
      facebook: {
        endpoints: {
          userInfo: 'https://graph.facebook.com/v6.0/me?fields=id,name,picture{url}'
        },
        redirectUri: `https://8b34-117-4-244-54.ap.ngrok.io/`,
        clientId: '1222548958316551',
        scope: ['public_profile', 'email']
      },
      google: {
        clientId: '698893895252-7v3jvf259aa1ol2f41n0cj6rkiu6sjob.apps.googleusercontent.com',
        redirectUri: `http://localhost:3000/register/`,
        codeChallengeMethod: '',
        scope: ['profile', 'email'],
        responseType: 'token id_token',
        prompt: 'select_account'
        },
      laravelJWT: {
        provider: 'laravel/jwt',
        url: envServer.baseUrl,
        endpoints: {
          login: { url: '/api/auth/login', methods: 'post' },
          logout: { url: '/api/admin/auth/logout', methods: 'post' },
          user: false,
        },
        refreshToken: {
          maxAge: 60 * 60,
        },
      },
    },
    redirect: {
      login: '/login',
      logout: '/login',
      callback: '/login',
      user: false,
    },
  },

  publicRuntimeConfig: {
    axios: {
      browserBaseURL: envServer.baseUrl,
    },
  },
  privateRuntimeConfig: {
    axios: {
      baseURL: envServer.baseUrl,
    },
  },
  router: {
    linkActiveClass: 'active',
    linkExactActiveClass: 'active',
  },
  server: {
    host: envServer.host,
  },
  toast: {
    position: 'bottom-right',
    duration: 2000,
    register: [
      {
        name: 'my-error',
        message: 'Oops...Something went wrong',
        options: {
          type: 'error',
        },
      },
    ],
  },
}
