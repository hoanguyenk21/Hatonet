module.exports = {
  parser: 'sugarss',
  stringifier: 'midas',
  plugins: [require('autoprefixer'), require('postcss-nested')],
}
