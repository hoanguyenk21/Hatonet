<template>
  <div class="block">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-7">
          <img src="@/assets/images/bg_hr.svg" />
        </div>
        <div class="col-12 col-md-5">
          <div  class="card">
            <div class="card__header">
              <h3>Đăng nhập</h3>
              <p>
                Kết nối hàng ngàn nhân sự chất lượng từ các doanh nghiệp ở khắp
                mọi nơi.
              </p>
            </div>
            <div class="form-control" :class="[{ 'has-error': errors.email }]">
              <label>Email</label>
              <input type="email" :class="[{ 'is-invalid': errors.email }]" v-model="auth.email" />
            </div>
            <span class="text-error" v-if="errors.email" v-text="errors.email[0]"></span>
            <div class="form-control" :class="[{ 'has-error': errors.password }]">
              <label>Mật khẩu</label>
              <div class="input">
                <input :class="[{ 'is-invalid': errors.password }]" :type="typePassword" v-model="auth.password" />
                <span class="input__extend" v-if="!errors.password" @click="isEye = !isEye">
                  <i v-if="!isEye" class="ti ti-live-photo"></i>
                  <i v-else class="ti ti-point"></i>
                </span>
              </div>
            </div>
            <span class="text-error" v-if="errors.password" v-text="errors.password[0]"></span>
            <div class="form-button">
              <button type="button" @click.prevent="handleSubmit">
                Đăng nhập
              </button>
            </div>
            <div class="hr">
              <span>Hoặc đăng nhập qua</span>
            </div>
            <auth-social label="Đăng nhập" />
            <div class="form-redirect">
              <nuxt-link to="/register">
                <span>Đăng ký tài khoản mới</span>
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                      d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                  </svg></span>
              </nuxt-link>
            </div>
            <div class="forgot">
              <nuxt-link to="/forgot">
                <span>Quên mật khẩu</span>
              </nuxt-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import AuthSocial from './common/AuthSocial.vue'
export default {
  middleware: 'auth',
  computed: { user() { return this.$auth.user; } },
  components: {
AuthSocial
     },
  data() {
    return {
        isLogin: false,
      auth: {},
      errors: {},
      isEye: false,
            isTokenValid: false,
      userEmail: '',
      message: '',
    }
  },
    async created () {
    if (this.token) {
      this.checkToken();
    }
  },
  computed: {
    typePassword() {
      return this.isEye ? 'text' : 'password'
    },
     token () {
      return this.$route.query.token || null;
    }
  },
  methods: {

    async handleSubmit() {
      try {
        const resp = await this.$store.dispatch('login', this.auth)
        console.log(resp)
        if (resp.status === 200) {
          this.$router.push('/admin')
          this.$toast.success('Đăng nhập thành công!')
        }
      } catch (error) {
        if (error.response.status === 422) {
          this.errors = this.$mixError(error)
          this.$toast.error(this.errors.message)
        }
      }
    },
  async checkToken () {
      const formSubmit = {
        token: this.token
      }
      try {
        const { data } = await this.$store.dispatch('confirm', formSubmit)
        this.isTokenValid = true;
        this.userEmail = data.email;
      } catch (error) {
        this.isTokenValid = false;
        this.message = 'Token invalid!';
        console.error('token invalid!', error);
      }
    }
  },
}
</script>

<style scoped lang="scss">
.form-redirect a:hover {
  color: #ff6600;
}

.block {
  background: linear-gradient(359deg, #ffffff, #fbefeb) no-repeat 0 20%;
  min-height: 80vh;
  padding: 3em 0;
}

.card {
  background-color: #fff;
  padding: 1.5em 2em;
  border-radius: 10px;
  box-sizing: border-box;
  box-shadow: 0px 9px 23px rgb(0 0 0 / 8%);

  &__header {
    text-align: center;

    h3 {
      font-weight: 700;
      font-size: 1.3rem;
      color: #455964;
    }

    p {
      font-size: 1rem;
      color: #7e7e7e;
      font-weight: 300;
      line-height: 1.3em;
    }
  }
}

.input {
  position: relative;

  &__extend {
    position: absolute;
    right: 15px;
    top: 9px;
  }
}

.form-redirect {
  text-align: center;

  a {
    background: #fff;
    text-decoration: none;
    padding: 0 1em;
    font-size: 0.8rem;
    color: #455a64;
    font-weight: 600;
  }

  span {
    margin-right: 0.2em;
  }
}

.has-error label {
  color: #ff1100 !important;
}

.form-control {
  padding: 0.5em 0;

  label {
    padding: 0 0.9em 0 0.5em;
    display: inline-block;
    margin-bottom: 0.3em;
    font-size: 0.8rem;
    font-weight: 400;
    color: #5c5c5c;
    position: relative;
    top: 14px;
    background: #fff;
    left: 20px;
    z-index: 1;
  }

  input {
    box-sizing: border-box;
    width: 100%;
    height: 38px;
    border: 1px solid #ebebeb;
    border-radius: 35px;
    padding: 0 1em;

    &:focus {
      outline: none;
    }
  }

  button {
    width: 100%;
    height: 38px;
    border-radius: 35px;
    background: #455a64;
    border: 2px solid #455a64;
    color: #ffff;
    font-weight: 600;
  }
}

.form-button {
  margin: 1.5em 0;

  button {
    width: 100%;
    height: 38px;
    border-radius: 35px;
    background: #455a64;
    border: 2px solid #455a64;
    color: #ffff;
    font-weight: 600;
  }

  &--social {
    background: #fff;
  }
}

.hr {
  border-bottom: 1px solid #ebebeb;
  text-align: center;
  margin: 2.5em 0;
  line-height: 0px;

  span {
    background: #fff;
    text-decoration: none;
    padding: 0 1em;
    font-size: 0.8rem;
    color: #455a64;
    font-weight: 400;
  }
}
.forgot{
  text-align: center;
  margin-top: 10px;
  a{
    text-decoration: none;
    &:hover{
      text-decoration: underline;
    }
  }
  span{
    text-decoration: none;
    padding: 0 1em;
    font-size: 0.8rem;
    color: #455a64;
    font-weight: 600;
  }

}
</style>
