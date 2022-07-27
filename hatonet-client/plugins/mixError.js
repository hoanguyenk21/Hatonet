export default (context, inject) => {
  const mixError = (error) => {
    if (error.response) {
      const code = error.response.status
      switch (code) {
        case 422:
          return error.response.data.errors
        case 401:
          context.$cookies.remove('_user')
          return error.response.data.errors

        default:
          console.warn(error.response.data.message)
          break
      }
    } else {
      console.warn('Loi ket noi may chu')
    }
  }
  inject('mixError', mixError)
  context.$mixError = mixError // context gán vào global this context
}
