<template>
  <div class="block block--price">
    <header class="block__header">
      <div class="container">
        <div class="block__title">
          <h3 class="title">Bảng giá dịch vụ</h3>
          <p class="description">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum
            dolor sit
          </p>
        </div>
      </div>
    </header>
    <div class="container">
      <div class="row">
        <div
          class="col-12 col-md-12 col-lg-4 mt-3"
          v-for="(item, i) in items"
          :key="i"
          :class="item.status != 'active' ? 'd-none' : ''"
        >
          <div v-if="item.status =='active'" class="card h-100">
            <div class="card__header">
              <span>{{ item.title }}</span>
              <div class="price">
                <p>
                  <span
                    >{{
                      new Intl.NumberFormat().format(item.price_base)
                    }}
                    VND</span>
                </p>
                <p>
                  Chỉ còn
                  {{ new Intl.NumberFormat().format(item.price_sale) }} VND
                </p>
              </div>
            </div>
            <div class="card__main">
              <ul>
                <li v-for="(meta, index) in item.service_meta" :key="index">
                  <span v-if="meta.meta_key == true" class="active">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="16"
                      height="16"
                      fill="currentColor"
                      class="bi bi-check-circle-fill"
                      viewBox="0 0 16 16"
                    >
                      <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"
                      />
                    </svg>
                  </span>
                  <span v-else>
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="icon text-danger"
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      stroke-width="2"
                      stroke="currentColor"
                      fill="none"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    >
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <line x1="18" y1="6" x2="6" y2="18"></line>
                      <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                  </span>
                  {{ meta.meta_value }}
                </li>
              </ul>
            </div>
            <div class="card__bottom">
              <nuxt-link :to="{ path: '/price-detail', query: { id: item.id }}">Chi tiết gói</nuxt-link>
              <div v-show="userCookie.roles != 'admin'">
                <div v-if="packageUsing.service_id == item.id">
                  <button disabled class="btn-success">
                    Đang sử dụng
                  </button>
                </div>
                <div v-else>
                  <button class="btn-active"
                    @click="redirectToService(item)"
                    :disabled="isDisabledBtn"
                    v-if="isShowBtnRegister(item.id)"
                  >
                    Đăng ký ngay
                  </button>
                  <button v-if="isShowBtnPending(item.id)" disabled class="btn-active">Chờ xử lý</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'

const STATUS = {
  ACTIVE: "active", PENDING: "pending"
}

const PAYLOAD = {}

export default {
  data() {
    return {
      userCookie: {},
      packageUsing: {},
      filterPackageUser:[],
    }
  },

  computed: {
    ...mapState('packages', ['packages']),
    ...mapState('service', ['items']),
    packagePending(){
      return this.filterPackageUser.find((order) => order.status == STATUS.PENDING) || {}
    },

    isDisabledBtn(){
      if(this.packagePending.status){
        return true
      } else {
        return false
      }
    },

    isShowBtnPending(){
      return (serviceId) => {
        return serviceId == this.packagePending.service_id
      }
    },

    isShowBtnRegister(){
      return (serviceId) => {
        return this.packagePending.service_id != serviceId
      }
    },
  },

  async fetch(){
    this.userCookie = await this.$cookies.get('_user') || {}
    await this.$store.dispatch('service/getServiceList') || []
    if(Object.keys(this.userCookie).length != 0 && this.userCookie.roles != 'admin'){
      await this.$store.dispatch('packages/getPackageList',PAYLOAD) || []
    }
    this.packageUsing = (await this.packages.find((x) => (x.user_id == this.userCookie.id) && (x.status == 'active'))) || {}
    this.filterPackageUser = await this.packages.filter((order) => {
      return order.user_id == this.userCookie.id
    }) || []
  },

  methods: {
    redirectToService(service) {
      if(Object.keys(this.userCookie).length === 0){
        if(confirm("Bạn phải đăng nhập nếu muốn sử dụng dịch vụ")){
          this.$router.push({ path: '/login' });
        }
        return
      }

      if (Object.keys(this.packageUsing).length === 0 || this.packageUsing.status == 'pending') {
        this.$router.push({ path: `/order/${service.id}`, params: { id: service.id } })
      } else {
        if (confirm(`Bạn đang sử dụng gói ${this.packageUsing.title}. Bạn chắc chắn muốn chuyển sang gói ${service.title} ?`)) {
          this.$router.push({ path: `/order/${service.id}`, params: { id: service.id } })
        }
        return
      }
    },

  },
}
</script>

<style lang="scss" scoped>
.block {
  padding: 6em 0 3em;
  &__header {
    font-weight: 700;
    font-size: 2rem;
    margin-bottom: 1.5em;
    .description {
      width: 80%;
      margin: 0 auto;
      font-size: 1.4rem;
      line-height: 1.9rem;
      font-weight: 300;
      color: #7e7e7e;
      text-align: center;
    }

    .title {
      text-align: center;
      font-size: 2rem;
      font-weight: 800;
      color: #455a64;
    }
  }
}

.card {
  background-color: #fff;
  padding: 1.5em 2em;
  border-radius: 35px;
  box-sizing: border-box;
  box-shadow: 0.1px 4px 13px rgb(0 0 0 / 2%);
  margin-bottom: 2em;
  &__header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 2em;
    span {
      font-size: 2rem;
      font-weight: bold;
    }
    p {
      margin: 0.2em;
    }
    h3 {
      font-weight: 700;
      font-size: 2rem;
    }

    .price {
      text-align: right;
      span {
        font-size: 1.2rem;
        color: #e65109;
      }
      p:last-child{
        font-weight: bold;
      }
    }
  }
  &__main {
    margin-bottom: 2em;
    ul {
      list-style: none;
      padding: 0;
      li {
        display: flex;
        align-items: center;
        margin-bottom: 0.5em;
        grid-gap: 1em;
        gap: 1em;
        font-size: 1rem;
        svg {
          width: 22px;
          height: 22px;
          fill: #f3f3f3;
        }
      }
      .active {
        svg {
          fill: #2fb344;
        }
      }
    }
  }

  &__bottom {
    button {
      display: block;
      width: 100%;
      margin-bottom: 1em;
      height: 45px;
      line-height: 43px;
      border: 2px solid #e65109;
      background-color: #fff;
      border-radius: 35px;
      color: #e65109;
      font-weight: bold;
      text-decoration: none;
      text-align: center;
    }
    a {
      display: block;
      width: 100%;
      margin-bottom: 1em;
      height: 45px;
      line-height: 43px;
      border: 2px solid #e65109;
      background-color: #fff;
      border-radius: 35px;
      color: #e65109;
      font-weight: bold;
      text-decoration: none;
      text-align: center;
    }
    .btn-success {
      background: #2fb344;
      color: #ffffff;
      border: 0;
    }
    .btn-active {
      background: #e65109 !important;
      color: #fff !important;
      &:disabled{
        opacity: 0.7;
      }
    }
  }
}

.text-danger{
  color: #d63939;
}

.h-100{
  height: 100%;
}
//responsive
//tablet
@media screen and (max-width: 1199px) {
  .card__header{
    display: block;
    text-align: center;
    .price{
      text-align: center;
    }
  }
}
</style>
