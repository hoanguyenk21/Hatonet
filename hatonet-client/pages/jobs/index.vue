<template>
  <main>
    <section-search :jobs="jobs" :valueSkill="valueSkill" :valueProvince="valueProvince" :valueSearch="valueSearch"
      v-model="valueSearch" @changeProvince="changeValueProvince" @changeSkill="changeValueSkill"
      @handleSearch="handleSearch" @removeValue="removeValue" />

    <div class="block block--feature">
      <div class="block__title">
        <div class="container">
          <h4>Việc làm tốt nhất</h4>
          <p>
            Lorem ipsum dolor sit, amet consectetur adipisicing elit.
            Consequuntur, aliquid!
          </p>
        </div>
      </div>
      <div class="block__main">
        <div class="container">
          <div class="row">
            <div class="col-12 col-md-12">
              <div class="jobs">
                <div v-for="job in jobsLoaded" :key="'job' + job.id" class="job-item"  v-if="job.status != 'pending'">
                  <nuxt-link :to="{ path: `/jobs/${job.id}` }">
                    <div class="job-item__image" v-if="job.user">
                      <SectionImage :src="baseUrl + job.user.avatar" />
                    </div>
                  </nuxt-link>
                  <div class="job-item__content">
                    <nuxt-link :to="{ path: `/jobs/${job.id}` }">
                      <div class="title">
                        {{ job.title }}
                      </div>
                    </nuxt-link>
                    <ul class="tags">
                      <li v-for="proMeta in job.product_meta" :key="'job_skill' + proMeta.id" v-if="proMeta.meta_key == '_skill'">
                        <div v-for="loca in options.skill">
                          <span v-if="proMeta.meta_value == loca.id"><i></i>{{ loca.name }}</span>
                        </div>
                      </li>
                    </ul>
                    <ul class="meta">
                      <li>
                        <i class="ti ti-building-skyscraper" v-if="job.user"><span>{{
                            job.user.name ? job.user.name : 'Chưa có'
                        }}</span></i>
                      </li>
                      <li v-for="proMeta in job.product_meta" :key="'job_address' + proMeta.id" v-if="proMeta.meta_key == '_address'">
                        <div v-for="loca in options.location">
                          <span v-if="proMeta.meta_value == loca.id"><i class="ti ti-map-pin"></i>{{ loca.name }}</span>
                        </div>
                      </li>
                      <li v-for="proMeta in job.product_meta" :key="'job_address' + proMeta.id"
                        v-if="proMeta.meta_key == '_dateline'"><i class="ti ti-calendar-event">{{ getDate(proMeta.meta_value) }}</i>
                      </li>
                      <div v-for="proMeta in job.product_meta" :key="'_dateline' + proMeta.id"></div>

                    </ul>
                  </div>
                  <div class="job-item__redirect">
                    <div class="price">
                      <small>Giá thuê</small>
                      <span>{{ new Intl.NumberFormat().format(job.price_sale) }} VND</span>
                    </div>
                    <nuxt-link :to="{ path: `/jobs/${job.id}` }">
                      <div class="title">
                        <i class="ti ti-arrow-right"></i>
                      </div>
                    </nuxt-link>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="block__bottom">
        <div class="load-more" >
          <button v-if="jobsLoaded.length == jobs.length && jobs.length >= 7" class="d-flex align-items-center" @click="collapseTo">
            Thu gọn
            <i class="ti ti-arrow-up-circle"></i>
          </button>
          <span v-else>
                 <button v-if="jobs.length > this.length"  @click="loadMore">
            <span>Xem thêm</span>
            <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                  d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z" />
              </svg></span>
          </button>
          </span>
         

        </div>
      </div>
    </div>
    <div class="block">
      <div class="block__title">
        <div class="container">
          <h4>Tin tuyển dụng</h4>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa, at!
          </p>
        </div>
      </div>
      <div class="block__main">
        <div class="container">
          <div class="row">
            <div class="col-12 col-md-12">
              <div class="jobs">
                <div v-for="job in jobs" :key="'job_meta' + job.id" class="job-item" v-if="job.status != 'pending'">
                  <nuxt-link :to="{ path: `/jobs/${job.id}` }">
                    <div class="job-item__image" v-if="job.user">
                      <SectionImage :src="baseUrl + job.user.avatar" />
                    </div>
                  </nuxt-link>
                  <div class="job-item__content">
                    <nuxt-link :to="{ path: `/jobs/${job.id}` }">
                      <div class="title">
                        {{ job.title }}
                      </div>
                    </nuxt-link>
                    <ul class="tags">
                      <li v-for="proMeta in job.product_meta" :key="'job_skill' + proMeta.id" v-if="proMeta.meta_key == '_skill'">
                        <div v-for="loca in options.skill">
                          <span v-if="proMeta.meta_value == loca.id"><i></i>{{ loca.name }}</span>
                        </div>
                      </li>
                    </ul>
                    <ul class="meta">
                      <li> <i class="ti ti-building-skyscraper" v-if="job.user"><span>{{ job.user.name
                      }}</span></i></li>
                      <li v-for="proMeta in job.product_meta" :key="'job_address' + proMeta.id"
                        v-if="proMeta.meta_key == '_dateline'">
                        <i class="ti ti-calendar-event">{{ getDate(proMeta.meta_value) }}</i>
                      </li>
                      <li v-for="proMeta in job.product_meta" :key="'job_address' + proMeta.id"
                        v-if="proMeta.meta_key == '_address'">
                        <div v-for="loca in options.location">
                          <span v-if="proMeta.meta_value == loca.id"><i class="ti ti-map-pin"></i>{{ loca.name }}</span>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <div class="job-item__redirect">
                    <div class="price">
                      <small>Giá thuê</small>
                      <span>{{ new Intl.NumberFormat().format(job.price_sale) }} VND</span>
                    </div>
                    <nuxt-link :to="{ path: `/jobs/${job.id}` }">
                      <div class="title">
                        <i class="ti ti-arrow-right"></i>
                      </div>
                    </nuxt-link>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="block__bottom">
        <div class="load-more">
          <button v-if="jobsLoaded.length == jobs.length && jobs.length >= 7" class="d-flex align-items-center" @click="collapseTo">
                Thu gọn
            <i class="ti ti-arrow-up-circle"></i>
          </button>
          <span v-else>
            <button  v-if="jobs.length > this.length" @click="loadMore">
                <span>Xem thêm</span>
                <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                      d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z" />
                  </svg></span>
            </button>
          </span>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import { mapState } from 'vuex'
import SectionSearch from '@/components/client/SectionSearch.vue'
import LoadMore from '@/components/LoadMore.vue'
import { LOCATION, SKILL, STATUS } from '../../constants/common'
import { baseUrl } from '@/env/env.development.js'
import SectionImage from '../../components/client/SectionImage.vue'

export default {
  components: { SectionSearch, LoadMore, SectionImage },
  data: () => ({
    options: {
      status: STATUS,
      location: LOCATION,
      skill:SKILL
    },
    term_id: '',
    product_meta: '',
    currentUser: '',
    length: 8,
    baseUrl: baseUrl,
    valueSearch: '',
    valueProvince: '',
    valueSkill: '',
  }),

  computed: {
    ...mapState('productClient', ['items']),
    jobsLoaded() {
      return this.jobs.slice(0, this.length);
    },

  },

  asyncData: async ({ $axios,error}) => {
    try {
    const { data: users } = await $axios.get(`/api/users`)
    const { data: jobs } = await $axios.get(`/api/jobs`)
    return { users, jobs }
    } catch (e) {
      error({
        statusCode: 404,
        message: '',
      })
    }
  },


  methods: {
    getDate (value) {
      if (typeof value === 'string') {
        
        return value.replace(/["\\]/g, '');
      }
      return value;
    },
    removeValue(value) {
      if (value == 1) {
        this.valueSearch = ""
      } else if (value == 2) {
        this.valueProvince = ""
      } else {
        this.valueSkill = ""
      }
    },
    async handleSearch() {
      await this.$store.dispatch('productClient/getProductList', {
        keyword: this.valueSearch, province: this.valueProvince, skill: this.valueSkill
      })
      this.jobs = this.items
    },
    handleChangeValueSearch(value) {
      this.valueSearch = value
    },

    changeValueProvince(value) {
      this.valueProvince = value
    },

    changeValueSkill(value) {
      this.valueSkill = value
    },

    loadMore() {
      if (this.length > this.jobs.length) return;
      this.length = this.length + 8;
    },

    collapseTo() {
      this.length = 8
    },

    loadNews() {

    },

    collapseNews() {

    },

  },
}

</script>

<style scoped lang="scss">
.ti-arrow-up-circle {
  font-size: 30px;
  margin-left: 10px;
}

.block {
  padding: 1.5em 0;

  &__title {
    margin-bottom: 2em;

    h4 {
      font-size: 1.6rem;
      font-weight: 800;
      color: #455a64;
    }

    p {
      font-size: 1.2rem;
      line-height: 1.9rem;
      font-weight: 300;
      color: #7e7e7e;
    }
  }

  &--feature {
    background: #fff;
  }
}

.jobs {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 15px;

  &--list {
    grid-template-columns: 1fr;

    .job-item {
      background-color: #ebebeb;
      box-shadow: none;
    }
  }

  @media (max-width: 990px) {
    display: block;

    .job-item {
      margin-top: 15px;
    }
  }
}

.job-item {
  display: flex;
  padding: 0.5em;
  background-color: #fff;
  gap: 15px;
  width: 100%;
  box-sizing: border-box;
  border-radius: 10px;
  box-shadow: 0.4px 0.4px 24px rgb(0 0 0 / 8%);

  .title {
    cursor: pointer;
  }

  img {
    border-radius: 10px;
    width: 100%;
    height: 100%;
  }

  &__content {
    flex: 2;
    justify-content: space-between;
    display: flex;
    flex-direction: column;

    a {
      font-size: 1.1rem;
      text-decoration: none;
      font-weight: 700;
      color: #000;
    }
  }

  &__image {
    width: 95px;
    height: 100%;
    display: inline-block;
    cursor: pointer;
  }

  &__redirect {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: flex-end;
    padding: 0 0.5em;

    a {
      font-size: 1rem;
      text-decoration: none;
      color: #ea530a;
    }

    .price {
      text-align: right;

      small {
        color: #455964;
        font-weight: 200;
      }

      span {
        display: block;
        font-weight: 700;
      }
    }
  }

  .tags {
    margin: 0;
    padding: 0;
    list-style: none;

    li {
      background: #f1f1f1;
      display: inline-block;
      padding: 0em 1.4em;
      font-size: 0.8em;
      border-radius: 30px;
    }
  }

  .meta {
    margin: 0;
    padding: 0;
    list-style: none;
    display: flex;
    color: #455964;
    font-size: 0.8rem;

    i {
      font-size: 0.8rem;
    }

    li {
      margin-right: 0.6em;
    }
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
