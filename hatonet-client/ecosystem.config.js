module.exports = {
  apps: [
    {
      name: 'nuxt-client',
      exec_mode: 'cluster',
      instances: 1,
      cwd: '/',
      script: './node_modules/nuxt-start/bin/nuxt-start.js',
      args: '-c /nuxt.config.js'
    }
  ]
}
