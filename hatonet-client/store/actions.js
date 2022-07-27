export default {
  login: async function ({ commit }, auth) {
    const resp = await this.$auth.loginWith('laravelJWT', { data: auth })
    this.$cookies.set('_user', resp.data.user)
    return resp
  },
  logout: async function () {
    this.$cookies.remove('_user')
    return await this.$auth.logout()
  },
  social: async function ({ commit }, type = '') {
    return await this.$axios.get(`/api/auth/social/${type}`)
  },
  register: async function ({ commit }, body) {
    return await this.$axios.post('/api/auth/register', body)
  },
  forgot: async function ({ commit }, body) {
    return await this.$axios.post('/api/auth/forgot', body)
  },
  reset: async function ({ commit }, body) {
    return await this.$axios.post('/api/auth/reset', body)
  },
  change: async function ({ commit }, body) {
    return await this.$axios.post('/api/auth/change', body)
  },
  confirm: async function ({ commit }, body) {
    return await this.$axios.post('/api/auth/confirm', body)
  },
}
