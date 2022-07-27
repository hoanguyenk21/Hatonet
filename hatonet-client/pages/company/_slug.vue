<template>
  <div class="block">
    <div class="block__banner">
      <!-- <div class="container"> -->
      <SectionImage class="banner" :src="baseUrl + user.avatar" />
      <!--</div> -->
    </div>
    <div class="block__tabs">
      <div class="container">
        <div class="nav">
          <ul id="tab">
            <li v-for="(tab, index) in tabTitle" :key="index" @click="clickTab(tab, index)"
              :class="{ 'active': currentTab == tab }">{{ tab }}</li>
          </ul>
          <div class="nav__button">
            <span>
              <button v-if="isFollowing" @click="unFollowing">Đang theo dõi</button>
              <button v-else class="follow" @click="followCompany">Theo dõi</button>
            </span>
            <button @click="openInterviewModal">Danh sánh việc</button>
          </div>
        </div>
      </div>
    </div>
    <div v-if="currentTab == tabTitle[0]" class="block__content">
      <div class="jobs">
        <div class="job-item" v-for="product in jobs" :key="product.id" v-if="product.user_id == user.id && product.status != 'pending'">
          <nuxt-link :to="{ path: `/jobs/${product.id}` }" class="job-item__image">
            <SectionImage class="avatar avatar-md me-3 bg-dark" :src="baseUrl + product.user.avatar" />
          </nuxt-link>
          <div class="job-item__content">
            <nuxt-link :to="{ path: `/jobs/${product.id}` }" class="title">{{ product.title }}</nuxt-link>
            <ul class="tags">
              <li>
                <div v-for=" proMe in product.product_meta" :key="proMe.id">
                  <div v-if="proMe.meta_key == '_skill'">
                    <div v-for="skill in options.skill">
                      <span v-if="proMe.meta_value == skill.id">
                        {{ skill.name }}
                      </span>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
            <ul class="meta">
              <li><i class="ti ti-building-skyscraper" v-if="product.user"><span>{{ product.user.name ?
                  product.user.name : 'Chưa có'
              }}</span></i></li>
              <li v-for="proMeta in product.product_meta" :key="'job_address' + proMeta.id"
                v-if="proMeta.meta_key == '_address'">
                <i class="ti ti-map-pin">{{ options.location[+proMeta.meta_value].name }}</i>
              </li>
              <li v-for="proMeta in product.product_meta" :key="'job_address' + proMeta.id"
                v-if="proMeta.meta_key == '_dateline'">
                <i class="ti ti-calendar-event">{{ getDate(proMeta.meta_value) }}</i>
              </li>
            </ul>
          </div>
          <div to="/" class="job-item__redirect">
            <div class="price">
              <small>Giá thuê</small>
              <span>{{ new Intl.NumberFormat().format(product.price_sale) }}đ</span>
            </div>
            <nuxt-link :to="{ path: `/jobs/${product.id}` }" class="title">
              <i class="ti ti-arrow-right"></i>
            </nuxt-link>
          </div>
        </div>
      </div>
    </div>
    <div v-if="currentTab == tabTitle[1]" class="block__content">
      <div class="jobs">
        <div class="job-item" v-for="post in posts.data" :key="post.id">
          <nuxt-link :to="{ path: `/posts/${post.id}` }" class="job-item__image">
            <SectionImage class="avatar avatar-md me-3 bg-dark" :src="baseUrl + post.image" />
          </nuxt-link>
          <div class="job-item__content">
            <nuxt-link :to="{ path: `/posts/${post.id}` }" class="title">{{ post.title }}</nuxt-link>
            <ul class="tags">
              <li v-if="post.term">{{ post.term.title }}</li>
              <li v-else>Chưa có</li>
            </ul>
            <ul class="meta">
              <li><i class="ti ti-calendar-event"><span>{{ post.created_at || 'Chưa có' }}</span></i></li>
              <li><i class="ti ti-eye"><span>{{ post.view || 'Chưa có' }}</span></i></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div v-if="currentTab == tabTitle[2]" class="block__content">
      <h4 class="block__title">Đánh giá</h4>
      <div v-for="review in reviewSeeMore" :key="review.id">
        <div>
          <div class="row">
            <div class="col-10">
              <div v-for="users in usersData" :key="users.id" v-if="review.user_id == users.id">
                <SectionImage class="img" :src="baseUrl + users.avatar" />
                <span>{{ users.name }}</span>
              </div>
              <p v-if="checkEdit != review.id">{{ review.comment }}</p>
              <input v-if="checkEdit == review.id" v-model="review.comment" type="text" name="" id="" />
            </div>
            <div class="col-2">
              <vue-rating v-if="review.rating" v-model="review.rating" :rating="review.rating" :star-size="15"
                text-class="customTextRating" :read-only="false" :max-rating="5" :show-rating="false"
                :increment="0.01" />
              <p v-if="checkEdit != review.id && $cookies.get('_user')">
                <span v-if="review.user_id == $cookies.get('_user').id"
                  @click="editCmt(review.id, review.comment)">Sửa</span>
              </p>
              <p v-if="checkEdit != review.id && $cookies.get('_user')">
                <span v-if="review.user_id == $cookies.get('_user').id" @click="Delete(review.id)">Xóa</span>
              </p>
              <p v-if="checkEdit == review.id" @click="saveCmt(review.id, review.comment)">
                Xác nhận
              </p>
              <p v-if="checkEdit == review.id" @click="cancelEdit(review.id)">
                Hủy
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="block__bottom">
        <div class="load-more">
          <button v-if="reviewSeeMore.length == review.length && review.length >= 5" class="d-flex align-items-center"
            @click="collapseTo">
            Thu gọn
            <i class="ti ti-arrow-up-circle"></i>
          </button>
          <span v-else>
            <button v-if="review.length > this.length" @click="loadMore">
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
      <div class="row">
        <div class="col-md-12">
          <div class="comment">
            <span>Bình luận</span>
            <textarea v-model="ratings.comment"></textarea>
            <vue-rating v-model="ratings.rating" :rating="ratings.rating" :star-size="32" text-class="customTextRating"
              :read-only="false" :max-rating="5" :show-rating="false" :increment="0.01" />
            <button class="submit" @click="setRating">Gửi đánh giá</button>
          </div>
        </div>
      </div>
    </div>
    <div v-if="interviewModalVisible" class="vodal-container">
      <div class="vodal-mask">
        <div class="vodal">
          <header>
            <div @click.prevent="closeModal" class="ti ti-x close"></div>
            <span class="header">
              <h4>Việc làm phù hợp</h4>
            </span>
          </header>

          <body>
            <div class="body">
              <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                  <tr>
                    <th class="w-50"></th>
                    <th>Địa chỉ</th>
                    <th>Thời gian</th>
                    <th>Mức lương</th>
                    <th>Trạng thái</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <DraggAble handle=".grab-move" ghost-class="ghost" tag="tbody">
                  <tr v-for="product in jobs" :key="product.id"
                    v-if="product.user_id == user.id && product.status == 'wait'">
                    <td>
                      <div class="d-flex py-1 align-items-center">
                        <SectionImage class="avatar avatar-md me-3 " :src="baseUrl + product.user.avatar" />
                        <div class="flex-fill">
                          <div>
                            <div class="font-weight-medium title">
                              <h6>{{ product.title }}</h6>
                            </div>
                          </div>
                          <ul class="tags">
                            <li>
                              <div v-for=" proMe in product.product_meta" :key="proMe.id">
                                <div v-if="proMe.meta_key == '_skill'">
                                  <div v-for="skill in options.skill">
                                    <span v-if="proMe.meta_value == skill.id">
                                      {{ skill.name }}
                                    </span>
                                  </div>
                                </div>
                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div v-for=" proMe in product.product_meta" :key="proMe.id">
                        <div v-if="proMe.meta_key == '_address'">
                          <div v-for="location in options.location">
                            <span v-if="proMe.meta_value == location.id">
                              {{ location.name }}
                            </span>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td>
                      <span>
                        {{ product.created_at }}
                      </span>
                    </td>
                    <td>
                      <strong>{{ new Intl.NumberFormat().format(product.price_sale) }}đ</strong>
                    </td>
                    <td><span class="badge bg-warning me-1"></span>{{ product.status }}</td>
                    <td class="text-end">
                    </td>
                    <td><button class="button_T" @click="applyJobs(product.id)">Ứng tuyển</button></td>
                  </tr>
                </DraggAble>
              </table>
            </div>
          </body>
          <div class="jobs">
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Vue from 'vue';
import { mapState } from 'vuex'
import { baseUrl } from '@/env/env.development.js'
import { LOCATION, SKILL, STATUS } from '../../constants/common'
import SectionImage from '../../components/client/SectionImage.vue'
export default {
  // layout: "layer.company",
  layout(context) {
    return 'default.auth'
  },
  components: { SectionImage },
  data: function () {
    return {
      customToolbar: [
        ['bold', 'italic', 'underline'],
        [{ list: 'ordered' }, { list: 'bullet' }],
        ['image'],
      ],
      options: {
        status: STATUS,
        location: LOCATION,
        skill: SKILL
      },
      length: 4,
      ratings: {},
      follows: {},
      checkEdit: '',
      currentCmt: '',
      tabTitle: ["Tin đăng", "Sự kiện", "Đánh giá"],
      currentTab: "Tin đăng",
      baseUrl: baseUrl,
      interviewModalVisible: false,
      isFollowing: false
    }
  },
  computed: {
    reviewSeeMore() {
      return this.review.slice(0, this.length);
    },
    ...mapState('review', ['reviews']),
    ...mapState('userClient', ['users']),
    ...mapState('follow', ['follow']),
  },

  asyncData: async ({ $axios, params, error, route, $cookies }) => {
    try {
      let idCompany = route.params.slug;
      let idUser = $cookies.get('_user') || {};
      const { user: user } = await $axios.$get(`/api/users/${params.slug}`)
      const review = user.ratings
      const { data: usersData } = await $axios.get(`/api/users`)
      const { data: jobs } = await $axios.get(`/api/jobs`)
      const { data: posts } = await $axios.get(`/api/post`)
      const { followss: following } = await $axios.$get(`/api/follows?idCompany=${idCompany}&idUser=${idUser.id}`)
      let isFollowing = false;
      if (following) {
        isFollowing = true;
      }
      return { user, usersData, jobs, posts, review, following, isFollowing }
    } catch (e) {
      error({
        statusCode: 404, message: ''
      });
    }
  },
  methods: {

    getDate(value) {
      if (typeof value === 'string') {

        return value.replace(/["\\]/g, '');
      }
      return value;
    },

    applyJobs(id) {
      let params = {
        idCompany: this.$route.params.slug,
        idUser: this.$cookies.get('_user') || {},
      }
      this.follows.user_id = params.idUser.id
      this.follows.company_id = params.idCompany
      try {
        if (!params.idUser.id || params.idUser.id == params.idCompany) {
          if (!params.idUser.id) {
            if (confirm('Bạn cần đăng nhập để ứng tuyển ?')) {
              this.$router.push({ path: `/login` })
            }
          } else {
            confirm('Bạn không thể tự ứng tuyển ?')
          }
        } else {
          this.$router.push({ path: '/company/apply', query: { id: id } })
        }
      } catch (error) {
        console.error(error)
      }

    },

    loadMore() {
      if (this.length > this.review.length) return;
      this.length = this.length + 4;
    },
    collapseTo() {
      this.length = 4
    },
    clickTab(tab) {
      this.currentTab = tab
    },
    async setRating() {
      let params = {
        idCompany: this.$route.params.slug,
        idUser: this.$cookies.get('_user') || {},
      }
      this.ratings.user_id = params.idUser.id
      this.ratings.company_id = params.idCompany
      try {
        if (!params.idUser.id || params.idUser.id == params.idCompany) {
          if (!params.idUser.id) {
            if (confirm('Bạn cần đăng nhập để đánh giá ?')) {
              this.$router.push({ path: `/login` })
            }
          } else {
            confirm('Bạn không thể tự đánh giá  ?')
          }
        } else {
          const user_ranting = (await this.$store.dispatch('review/getAll', params)).data.reviewRating
          if (!user_ranting) {
            if (this.ratings.rating) {
              this.ratings.parent = 1
              await this.$store.dispatch('review/create', { idCompany: params.idCompany, data: this.ratings })
              this.review = (await this.$store.dispatch('userClient/getUser', params.idCompany)).data.user.ratings
            } else {
              this.ratings.parent = 0
              await this.$store.dispatch('review/create', { idCompany: params.idCompany, data: this.ratings })
              this.review = (await this.$store.dispatch('userClient/getUser', params.idCompany)).data.user.ratings
            }
          } else {
            this.ratings.parent = 0,
              this.ratings.rating = null,
              await this.$store.dispatch('review/create', { idCompany: params.idCompany, data: this.ratings })
            this.review = (await this.$store.dispatch('userClient/getUser', params.idCompany)).data.user.ratings
          }
        }
      } catch (error) {
        this.errors = this.$mixError(error)
      }
    },
    async Delete($id) {
      if (confirm('Bạn có chắc chắn muốn xóa không ?')) {
        await this.$store.dispatch('review/remove', $id)
        this.review = (await this.$store.dispatch('userClient/getUser', this.$route.params.slug)).data.user.ratings
      }
    },
    async editCmt(id, comment) {
      this.checkEdit = id
      this.currentCmt = comment
    },
    async cancelEdit(id) {
      for (const key in this.review) {
        //This will give key
        //This will give value
        if (this.review[key].id == id) {
          this.review[key].comment = this.currentCmt
        }
      }
      this.currentCmt = null
      this.checkEdit = null
    },
    async saveCmt(id, comment) {
      let params = {
        id: id,
        comment: comment
      }
      let resp = await this.$store.dispatch('review/update', params)
      for (const key in this.review) {
        //This will give key
        //This will give value
        if (this.review[key].id == id) {
          this.review[key] = resp.data
        }
      }
      this.currentCmt = null
      this.checkEdit = null
    },
    openInterviewModal() {
      this.interviewModalVisible = true;
    },
    closeModal() {
      this.interviewModalVisible = false;
    },
    async followCompany() {
      let params = {
        idCompany: this.$route.params.slug,
        idUser: this.$cookies.get('_user') || {},
      }
      this.follows.user_id = params.idUser.id
      this.follows.company_id = params.idCompany
      try {
        if (!params.idUser.id || params.idUser.id == params.idCompany) {
          if (!params.idUser.id) {
            if (confirm('Bạn cần đăng nhập để theo dõi ?')) {
              this.$router.push({ path: `/login` })
            }
          } else {
            confirm('Bạn không thể tự theo dõi ?')
          }
        } else {
          this.isFollowing = true
          await this.$store.dispatch('follow/create', { idCompany: params.idCompany, data: this.follows })
        }
      } catch (error) {
        console.error(error)
      }
    },
    async unFollowing() {
      let idCompany = this.$route.params.slug;
      let idUser = this.$cookies.get('_user') || {};
      const id = (await this.$axios.$get(`/api/follows?idCompany=${idCompany}&idUser=${idUser.id}`)).followss.id
      await this.$store.dispatch('follow/remove', id)
      this.isFollowing = false
    }
  },
}
</script>

<style scoped lang="scss">
.button_T {
  padding: 0em 0.5em;
  border-radius: 35px;
  border: none;
  background: #ea530a;
  color: #fff;
  margin-left: 1em;
  font-weight: 600;
  border: 2px solid #ea530a;
}

.tags {
  display: flex;
  list-style: none;
  padding: 0;
  margin: 0;
  grid-gap: 10px;
  gap: 10px;
  height: 30px;
  align-items: flex-end;

  li {
    background: hsl(14deg 100% 77% / 15%);
    border: 1px solid hsl(14deg 100% 77% / 52%);
    padding: 0 1em;
    border-radius: 35px;
    font-size: 0.8rem;
    color: #ff5400;
    font-weight: 500;
  }
}

.table {
  width: 100%;
  margin-bottom: 1rem;
  color: inherit;
  vertical-align: top;
  border-color: rgba(98, 105, 118, 0.16);
}

.avatar {
  border-radius: 10px;
  width: 80px;
}

.header {
  text-align: center;
}

.body {
  padding-left: 10px;
  padding-right: 10;
}

.close {
  margin-top: 13px;
  padding-left: 11px;
}

.vodal-mask {
  z-index: 10;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.35);
}

.vodal {
  position: absolute;
  background: #f8f8f8;
  z-index: 9999;
  width: 750px;
  height: 500px;
  top: 90px;
  left: 412px;
  right: 412px;
  border-radius: 10px;
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

.block__banner {
  border-radius: 10px !important;
  padding: 0px !important;
}

.banner {
  width: 100%;
  height: 100%;
  border-radius: 10px;
}

.img {
  height: 40px;
  width: 40px;
  border-radius: 50%;
}

.comment {
  textarea {
    width: 100%;
    height: 80px;
    border: 1px solid #f1f1f1;
    border-radius: 5px;
  }
}

.block__title {
  font-size: 1.3rem;
  font-weight: 700;
  margin: 1em 0.0em;
}

.submit {
  background: rgba(0, 0, 0, 0);
  color: #455a64;
  border: 2px solid #455a64 !important;
  text-decoration: none;
  padding: 0.5em 3em;
  border-radius: 30px;
  font-weight: 700;
  margin: 1em 0;
}

.block {
  &__banner {
    background: #0002;
    padding: 2em;
    border-radius: 20px;
    height: 325px;
  }
}

.content {
  margin-bottom: 2em;
  background: #fff9;
  border-radius: 10px;
  padding: 2em;
}

.nav {
  align-items: center;
  font-weight: 400;
  display: flex;
  list-style: none;
  justify-content: space-between;
  padding: 2em 0.5em;

  ul {
    display: flex;
    margin-bottom: 0;
    list-style: none;
    padding: 0px;

    li {
      cursor: pointer;
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

  button {
    padding: 0.4em 3em;
    border-radius: 35px;
    border: none;
    background: #ea530a;
    color: #fff;
    margin-left: 1em;
    font-weight: 600;
    border: 2px solid #ea530a;
  }

  .follow {
    border: 2px solid #212529;
    background: #0000;
    color: #212529;
  }

  .active {
    font-weight: bold;
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
    display: inline-block;
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

tr {
  &:hover {
    background: #fafafa;

    .title {
      color: #000;
    }
  }
}
</style>
