<template>
  <div id="wrapper">
    <div class="header">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-4 col-md-2">
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
          <div class="col-6 col-md-6">
            <div class="nav nav--menu">
              <ul>
                <li>
                  <nuxt-link to="/price" rel="home" exact-active-class="active">
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
        </div>
      </div>
    </div>
    <main class="page">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-3">
            <div class="menu">
              <div class="infomation">
                <div class="avatar">
                  <SectionImage class="img" :src="baseUrl + user.avatar" />
                </div>
                <div>
                  <h4 class="brandname">{{ user.name }}</h4>
                  <span>{{ user.roles }}</span>
                  <div class="check">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="16"
                      height="16"
                      fill="currentColor"
                      class="bi bi-patch-check-fill"
                      viewBox="0 0 16 16"
                    >
                      <path
                        d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"
                      />
                    </svg>
                    Đã xác thực
                  </div>
                </div>
              </div>
              <p>{{ user.description || 'chưa cập nhật' }}</p>
              <div class="aside">
                <h6>Thông tin</h6>
                <ul>
                  <li>Lĩnh vực: <span>Product</span></li>
                  <li>
                    Địa chỉ :
                    <span v-for="meta in user.meta" :key="meta.id" v-if="meta.meta_key == '_address'">
                        <div v-for="loca in options.location" v-if="meta.meta_value == loca.id">
                              {{ loca.name }}
                        </div>
                    </span
                    >
                  </li>
                  <li>
                    <span><i class="ti ti-star"></i> Đánh giá</span>
                    <span>{{ user.rating || 0 }}/5</span>
                  </li>
                  <li>
                    <span><i class="ti ti-briefcase"></i> Công việc</span>
                    <span>{{ userCount || 0 }}</span>
                  </li>
                </ul>
                <h6>Công nghệ hoạt động</h6>
                <div v-for="meta in user.meta" :key="meta.id">  
                  <ul class="tags" v-if="meta.meta_key == '_skill'">
                    <span v-for=" (val) in getData(meta.meta_value)" :key="val">
                       <li>{{ val }}</li>                 
                    </span>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-9">
            <nuxt />
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script>
import { baseUrl } from '@/env/env.development.js'
import SectionImage from '../components/client/SectionImage.vue'
import { LOCATION } from '../constants/common'
export default { 
  name: 'layer.company',
  head() {
    return {
      title: 'Hatonet - Nền tảng tuyển dụng nhân viên onsite',
      bodyAttrs: {
        class: 'theme-light',
      },
    }
  },
  components: { SectionImage },
  data: function () {
    return {
      user: {},
      userCount: '',
      baseUrl: baseUrl,
      options: {
      location: LOCATION,
      },
    }
  },

  async created() {
    let id = this.$route.params.slug
    const resp = await this.$axios.get(`/api/users/${id}`)
    this.user = resp.data.user
    this.userCount = resp.data.userCount
    
  },
  methods: {
    getData (param) {
      return JSON.parse(param)
    }
  }
  //   asyncData: async ({ $axios, error,params }) => {
  //   try {
  //     const user = (await $axios.get(`/api/users/${params.slug}`)).data.user
  //     return { user}
  //   } catch (e) {
  //     error({
  //       statusCode: 404,
  //       message: '',
  //     })
  //   }
  // },
}
</script>


<style lang="scss" scoped>
.infomation {
  display: flex;
  align-items: center;
  gap: 1em;
  margin-bottom: 1em;
  .brandname {
    font-size: 1.1rem;
    font-weight: 700;
    margin: 0;
  }
  .check {
    color: #ea530a;
    margin: 0.3em 0;
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 0.8rem;
    svg {
      fill: #ea530a;
    }
  }
}
.tags {
  margin: 0;
  padding: 0;
  list-style: none;
  display: flex;
  gap: 0.5em;
  flex-wrap: wrap;
  li {
    background: #d2d3d6;
    color: #313131;
    display: inline-block;
    padding: 0.2em 1.4em;
    font-size: 0.8em;
    border-radius: 30px;
  }
}

.aside {
  ul {
    padding: 0;
    li {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 0.5em;
    }
  }
}
.auth {
  display: flex;
  align-items: center;
  justify-content: flex-end;

  &__detail {
    flex: 1;
    display: flex;
    flex-direction: column;
    width: 110px;
    align-items: center;
  }

  button {
    border: 2px solid #455964;
    border-radius: 35px;
    padding: 0.1em;
    height: auto;
    min-width: 131.8px;
    display: flex;
    justify-content: space-between;
    gap: 5px;
    align-items: center;
    background: transparent;
    line-height: 1rem;
    span {
      min-width: 130px;
      padding: 0 0.2em;
      display: inline-block;
      font-weight: 700;
      font-size: 0.8rem;
    }
    small {
      font-size: 0.7rem;
      color: #ea530a;
      line-height: 0.8rem;
    }
  }
  .avatar {
    width: 30px;
    height: 30px;
  }
}

.avatar {
  width: 75px;
  height: 75px;
  border-radius: 50%;
  overflow: hidden;

  display: inline-block;
  img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
}

.infomation {
  display: flex;
  align-items: center;
  gap: 1em;
  margin-bottom: 1em;
}
.page {
  padding: 3em 0;
}
aside {
  border: 2px solid #d2d3d6;
  background: #d2d3d6;
  padding: 2em 0.5em;
  margin-bottom: 2em;
  border-radius: 20px;
}
.header {
  padding: 0.8em 0px;
  background-color: #fff;
}
.auth {
  text-align: right;
  a {
    text-decoration: none;
    margin-left: 1em;
    padding: 0.5em 3em;
    border-radius: 30px;
    border: 2px solid #253237;
  }
  &__login {
    background: #0000;
    color: #253237;
  }
  &__register {
    background: #253237;
    color: #ea530a;
  }
}

.nav {
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
}

.menu {
  position: sticky;
  top: 30px;
}
</style>>

