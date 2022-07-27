<template>
  <div class="block">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-7">
          <div class="bg-image">
            <img src="@/assets/images/bg_register.svg" />
          </div>
        </div>
        <div class="col-12 col-md-5">
          <div class="card">
            <div class="card__header">
              <h3>Đăng ký tài khoản</h3>
              <p>
                Để tiếp cận hàng ngàn nhân sự chất lượng tốt từ các doanh nghiệp
                ở khắp mọi nơi.
              </p>
            </div>
            <form @submit="handleSubmit">
              <div class="form-control" :class="[{ 'has-error': errors.name }]">
                <label>Tên công ty</label>
                <input
                  type="text"
                  :class="[{ 'is-invalid': errors.name }]"
                  v-model="auth.name"
                />
              </div>
               <span
                class="text-error"
                v-if="errors.name"
                v-text="errors.name[0]"
              ></span>
              <div
                class="form-control"
                :class="[{ 'has-error': errors.email }]"
              >
                <label>Email</label>
                <input
                  type="email"
                  :class="[{ 'is-invalid': errors.email }]"
                  v-model="auth.email"
                />
              </div>
              <span
                class="text-error"
                v-if="errors.email"
                v-text="errors.email[0]"
              ></span>
              <div
                class="form-control"
                :class="[{ 'has-error': errors.password }]"
              >
                <label>Mật khẩu</label>
                <div class="input">
                  <input
                    :class="[{ 'is-invalid': errors.password }]"
                    :type="typePassword"
                    v-model="auth.password"
                  />
                  <span
                    class="input__extend"
                    v-if="!errors.password"
                    @click="isEye = !isEye"
                  >
                    <i v-if="!isEye" class="ti ti-live-photo"></i>
                    <i v-else class="ti ti-point"></i>
                  </span>
                </div>
              </div>
              <span
                class="text-error"
                v-if="errors.password"
                v-text="errors.password[0]"
              ></span>
              <div class="form-button">
                <button>Đăng ký</button>
              </div>
            </form>
            <div class="hr">
              <span>Hoặc đăng ký qua</span>
            </div>
            <auth-social label="Đăng ký" />
            <div class="form-redirect">
              <nuxt-link to="/login">
                <span>Đăng nhập</span>
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
  components: { AuthSocial },
  data() {
    return {
      auth: {},
      errors: {},
      isEye: false,
    }
  },
  async created () {
    console.log(this.$router.query);
  },
  computed: {
    typePassword() {
      return this.isEye ? 'text' : 'password'
    },
  },
  methods: {
    handleSubmit: async function (e) {
      e.preventDefault()
      try {
        await this.$store.dispatch('register', this.auth)
        this.$router.push('/login')
         this.$toast.success('Đăng ký thành công!')
      } catch (error) {
        this.errors = this.$mixError(error)
        // this.$toast.error('Đăng ký thất bại!')
      }
    },
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
.bg-image {
  padding: 0 5em;
}
.btn-outline {
  background: #fff !important;
  color: #455a64 !important;
  gap: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  .icon {
    svg {
      width: 25px;
      height: 25px;
    }
  }
  .text {
    width: 180px;
    text-align: left;
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

.form-control {
  label {
    padding: 0 0.9em 0 0em;
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
</style>
