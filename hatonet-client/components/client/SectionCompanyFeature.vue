<template>
  <div class="block block--company">
    <div class="container">
      <div class="block__title">
        <h3>Công ty nổi bật</h3>
        <p>Danh sách công ty IT được đánh giá tốt nhất đang tuyển dụng</p>
      </div>
      <div class="row">
        <div class="col-md-3" v-for="user  in company" :key="user.id"  >
          <div  class="box" >
            <nuxt-link :to="{ path: `/company/${user.id}` }"> 
            <SectionImage   class="img" :src="baseUrl + user.avatar"  />  
            </nuxt-link>
            <nuxt-link
              :to="{ path: `/company/${user.id}` }"
              class="title"
            >
              <h4 class="title">{{ user.name }}</h4>
            </nuxt-link>
            <div>
              <ul class="meta">
                <li>
                  <i class="ti ti-briefcase">{{ user.count_product || 0 }}</i>
                </li>
                <li>
                  <i class="ti ti-message">{{ user.count_commnet || 0 }}</i>
                </li>
                <li><i class="ti ti-star"></i>{{ user.rating || 0 }}/5</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="block__bottom">
        <div class="load-more">
          <!-- <button @click="companiesVisible">
            <span>Xem thêm</span>
            <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                  d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z" />
              </svg></span>
          </button> -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { baseUrl } from '@/env/env.development.js'
import SectionImage from '../../components/client/SectionImage.vue'
export default {
  props: ['users'],
  data: function () {
    return {
      baseUrl: baseUrl,
      length:4,
    }
  },
  components: { SectionImage },
  computed: {
    company() {
      return this.users.filter(user => user.roles == 'company').slice(0, this.length)
    },
  },
  methods: {
    // companiesVisible() {
    //   if (this.length > this.users.length) return;
    //   this.length = this.length + 4;
    // },
  },
}
</script>

<style scoped lang="scss">
.block {
  padding: 3em 0;
  background: linear-gradient(359deg, #ffffff, #fbefeb) no-repeat 0 20%;

  &__title {
    h3 {
      font-size: 2rem;
      font-weight: 800;
      color: #455a64;
    }

    p {
      font-size: 1.4rem;
      line-height: 1.9rem;
      font-weight: 300;
      color: #7e7e7e;
    }

    margin-bottom: 2.5em;
    text-align: center;
  }
}

.title {
  font-size: 1.2rem;
  font-weight: 700;
  margin: 0.5em 0;
  color: #455a64;
  text-decoration: none;
}

.meta {
  display: flex;
  justify-content: space-around;
  list-style: none;
  padding: 0;
  font-weight: 300;
  color: #7e7e7e;
}

.box {
  border-radius: 20px;
  overflow: hidden;
  padding: 0;
  text-align: center;
  background: #fff;
  border: 1px solid #ebebeb;
  margin-bottom: 2em;

  img {
    width: 100%;
  }
}

.load-more {
  display: flex;
  justify-content: center;
  margin: 3em 0 0;
  gap: 10px;

  button {
    border: none;
    background: transparent;
    color: #9b9b9b;
    font-size: 1rem;

    svg {
      width: 25px;
      height: 25px;
      fill: #9b9b9b;
    }

    span {
      padding-right: 5px;
    }
  }
}
</style>
