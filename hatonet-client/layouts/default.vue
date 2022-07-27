<template>
  <div id="wrapper">
    <div class="header">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12 col-md-2 col-lg-2">
            <div class="logo">
              <nuxt-link to="/" rel="home">
                <img
                  :src="require('@/assets/images/hatonet.svg')"
                  width="180"
                  alt="hatonet"
                  title="Hatonet -  Nền tảng tuyển dụng hàng đầu việt nam"
                />
              </nuxt-link>
            </div>
          </div>
          <!-- /logo -->
          <div class="col-12 col-md-6 col-lg-6">
            <div class="nav nav--menu">
              <ul>
                <li>
                  <nuxt-link rel="home" to="/price" exact-active-class="active">
                    <span>Bảng giá</span>
                  </nuxt-link>
                </li>
                <li>
                  <nuxt-link
                    to="/company"
                    rel="home"
                    exact-active-class="active"
                  >
                    <span>Công ty</span>
                  </nuxt-link>
                </li>
                <li>
                  <nuxt-link to="/jobs" rel="home" exact-active-class="active">
                    <span>Việc làm</span>
                  </nuxt-link>
                </li>
                <li>
                  <nuxt-link to="/posts" rel="home" exact-active-class="active">
                    <span>Tin tức</span>
                  </nuxt-link>
                </li>
                <li>
                  <nuxt-link
                    to="/contact"
                    rel="home"
                    exact-active-class="active"
                  >
                    <span>Liên hệ</span>
                  </nuxt-link>
                </li>
              </ul>
            </div>
          </div>
          <!-- /menu -->
          <div class="col-12 col-md-4 col-lg-4">
            <div v-if="isLogin" class="auth">
              <nuxt-link to="/login" class="auth__login">
                <span>Đăng nhập</span>
              </nuxt-link>
              <nuxt-link to="/register" class="auth__register">
                <span>Đăng ký</span>
              </nuxt-link>
            </div>
            <div v-else class="auth">
              <nuxt-link to="/admin" class="auth__singin">
                <span>
                  <p>{{ $cookies.get('_user').name }}</p>
                  <small>Basic</small>
                </span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <path
                    d="M512 256c0-141.4-114.6-256-256-256S0 114.6 0 256c0 141.4 114.6 256 256 256S512 397.4 512 256zM265.9 382.8C259.9 380.3 256 374.5 256 368v-64H160c-17.67 0-32-14.33-32-32v-32c0-17.67 14.33-32 32-32h96v-64c0-6.469 3.891-12.31 9.875-14.78c5.984-2.484 12.86-1.109 17.44 3.469l112 112c6.248 6.248 6.248 16.38 0 22.62l-112 112C278.7 383.9 271.9 385.3 265.9 382.8z"
                  />
                </svg>
              </nuxt-link>
            </div>
          </div>
        </div>
      </div>
    </div>
    <nuxt />
    <the-client-footer />
  </div>
</template>

<script>
import TheClientFooter from '@/components/client/common/TheClientFooter.vue'
export default {
  components: { TheClientFooter },
  head() {
    return {
      title: 'Hatonet - Nền tảng tuyển dụng nhân viên onsite',
      bodyAttrs: {
        class: 'theme-light',
      },
    }
  },
  data: () => ({
    isLogin: false,
  }),
  created() {
    const user = this.$cookies.get('_user')
    // set login
    if (user && user.id) {
      this.isLogin = false
    } else {
      this.isLogin = true
    }
  },
}
</script>


<style scoped lang="scss">
.header {
  padding: 0.8em 0;
  background-color: #fff;
}
.auth {
  text-align: right;
  display: none;
  a {
    text-decoration: none;
    margin-left: 1em;
    padding: 0em 3em;
    height: 35px;
    line-height: 33px;
    display: inline-block;
    border-radius: 30px;
    border: 2px solid #f60;
    font-weight: 700;
    box-sizing: border-box;
    &:hover {
      color: #455a64;
    }
  }
  &__login {
    background: #0000;
    color: #455a64;
    border: 2px solid #455a64 !important;
  }
  &__register {
    background: #f60;
    color: #ffffff;
    &:hover {
      color: #fff !important;
    }
  }
  &__singin {
    background: #f60;
    color: #ffffff;
    padding: 0 2em !important;
    font-weight: 700;
    line-height: 12px !important;
    display: inline-flex !important;
    align-items: center;
    gap: 10px;
    p {
      font-size: 0.9em;
      line-height: 1em;
      margin: 0;
    }
    small {
      font-size: 0.7rem;
      font-weight: 100;
    }
    svg {
      width: 22px;
      height: 22px;
      fill: #ffff;
    }
    &:hover {
      color: #fff !important;
    }
  }
  .avatar {
    width: 30px;
    height: 30px;
  }
  // tablet
  @media (min-width: 769px) {
    display: none;
  }
  @media (min-width: 1028px) {
    display: block;
  }
}
.nav {
  display: none;
  ul {
    display: flex;
    margin-bottom: 0;
    list-style: none;
    padding: 0px;
    li {
      margin-right: 20px;
    }
    a {
      text-decoration: none;
      font-weight: 600;
      color: #455a64;
      font-size: 0.9rem;
      letter-spacing: 0.5px;
    }
  }
  // tablet
  @media (min-width: 769px) {
    display: none;
  }
  @media (min-width: 1028px) {
    display: block;
  }
}
</style>

