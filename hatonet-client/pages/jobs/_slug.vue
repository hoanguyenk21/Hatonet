<template>
  <div class="container">
    <div class="row">
      <aside class="col-12 col-md-3">
        <div class="box">
          <div class="infomation">
            <div class="avatar">
              <SectionImage class="img" :src="baseUrl + user.avatar" />
            </div>
            <div>
              <h4 class="brandname">{{ user.name }}</h4>
              <span>{{ user.roles ? user.roles : 'chưa có' }}</span>
              <div class="check">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                  class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                  <path
                    d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z" />
                </svg>
                Đã xác thực
              </div>
            </div>
          </div>
          <p></p>
          <ul>
            <li>
              Địa chỉ :
              <div v-for="meta in user.meta" :key="meta.id">
                <span v-if="meta.meta_key == '_address'">{{
                    meta.meta_value
                }}</span>
              </div>
            </li>
            <li>
              <span><i class="ti ti-star"></i> Đánh giá</span>
              <span>{{ user.rating || 0 }}/5</span>
            </li>
            <li>
              <span><i class="ti ti-briefcase"></i> Công việc</span>
              <span>{{ user.userCount || 0 }}</span>
            </li>
          </ul>
          <nuxt-link class="box__button" :to="{ path: `/company/${user.id}` }">
            Đến công ty
          </nuxt-link>
        </div>
        <div class="support">
          <img src="@/assets/images/contact.svg" />
        </div>
      </aside>
      <div class="col-12 col-md-9">
        <main>
          <article class="content">
            <div class="content__title">
              <div>
                <h1>{{ jobDetail.product.title }}</h1>
                <span>{{ jobDetail.product.roles }}</span>
                <p>
                  Giá tiền :
                  <span>{{
                      new Intl.NumberFormat().format(jobDetail.product.price_sale)
                  }}</span>
                  VND
                </p>
              </div>
              <div class="aplly">
                <button>Ứng tuyển</button>
                <small>Hạn ứng tuyển:
                  <span>{{
                      jobDetail.meta._dateline
                  }}</span>
                </small>
              </div>
            </div>
            <h6>Mô tả</h6>
            <div class="content__html mb-3">
              {{ jobDetail.product.description }}
            </div>
            <h6>Nội dung</h6>
            <div class="content__html">
              {{ jobDetail.product.content }}
            </div>
          </article>
          <h4 class="block__title">Có thể bạn quan tâm</h4>
          <div class="jobs">
            <div class="job-item" v-for="product in jobsRelated" :key="product.id" v-if="product.status != 'pending'">
              <nuxt-link :to="{ path: `/jobs/${product.id}` }" class="job-item__image">
                <SectionImage class="avatar avatar-md me-3 bg-dark" :src="baseUrl + product.user.avatar" />
              </nuxt-link>
              <div class="job-item__content">
                <nuxt-link :to="{ path: `/jobs/${product.id}` }" class="title">{{ product.title }}</nuxt-link>
                <ul class="tags">
                  <div v-for="proMeta in product.product_meta" :key="'job_skill' + proMeta.id">
                    <li>
                      <i class="ti ti-map-pin" v-if="proMeta.meta_key == '_skill'">{{ proMeta.meta_value }}</i>
                    </li>
                  </div>
                </ul>
                <ul class="meta">
                  <li><i class="ti ti-building-skyscraper"><span>{{ product.user.name }}</span></i></li>
                  <div v-for="proMeta in product.product_meta" :key="'job_address' + proMeta.id">
                    <li>
                      <i class="ti ti-map-pin" v-if="proMeta.meta_key == '_address'">{{ proMeta.meta_value }}</i>
                    </li>
                    <li>
                      <i class="ti ti-calendar-event" v-if="proMeta.meta_key == '_dateline'">{{ proMeta.meta_value
                      }}</i>
                    </li>
                  </div>
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
          <h4 class="block__title">Đánh giá</h4>
          <div v-for="review in reviewSeeMore" :key="review.id">
            <div>
              <div class="row">
                <div class="col-10">
                  <div v-for="users in users" :key="users.id" v-if="review.user_id == users.id">
                    <SectionImage class="img" :src="baseUrl + users.avatar" />
                    <span>{{ users.name }}</span>
                  </div>
                  <p v-if="checkEdit != review.id">{{ review.comment }}</p>
                  <input v-if="checkEdit == review.id" v-model="review.comment" type="text" name="" id="" />
                </div>
                <div class="col-2" style="text-align: right">
                  <vue-rating v-if="review.rating" v-model="review.rating" :rating="review.rating" :star-size="15"
                    text-class="customTextRating" :read-only="false" :max-rating="5" :show-rating="false"
                    :increment="0.01" />
                  <p v-if="checkEdit != review.id && $cookies.get('_user')">
                    <span @click="editCmt(review.id, review.comment)"
                      v-if="review.user_id == $cookies.get('_user').id">Sửa</span>
                  </p>
                  <p v-if="checkEdit != review.id && $cookies.get('_user')">
                    <span @click="Delete(review.id)" v-if="review.user_id == $cookies.get('_user').id">Xóa</span>
                  </p>
                  <p v-if="checkEdit == review.id" @click="saveCmt(review.id, review.comment)">
                    Xac Nhan
                  </p>
                  <p v-if="checkEdit == review.id" @click="cancelEdit(review.id)">
                    Huy
                  </p>
                </div>
              </div>
            </div>
          </div>
               <div class="block__bottom">
        <div class="load-more">
          <button v-if="reviewSeeMore.length == review.length && review.length >= 5" class="d-flex align-items-center" @click="collapseTo">
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
          <div class="comment">
            <h4 class="block__title">Bình luận</h4>
            <textarea v-model="ratings.comment"></textarea>
            <vue-rating v-model="ratings.rating" :rating="ratings.rating" :star-size="32" text-class="customTextRating"
              :read-only="false" :max-rating="5" :show-rating="false" :increment="0.01" />
            <button class="submit" @click="setRating">Gửi bình luận</button>
          </div>
        </main>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'
import { LOCATION } from '../../constants/common'
import { baseUrl } from '@/env/env.development.js'
import SectionImage from '../../components/client/SectionImage.vue'
export default {
  components: { SectionImage },
  data: () => ({
    options: {
      location: LOCATION,
    },
    ratings: {},
    length: 4,
    checkEdit: '',
    currentCmt: '',
    baseUrl: baseUrl,
  }),
  computed: {
    reviewSeeMore() {
      return this.review.slice(0, this.length);
    },
    ...mapState('review', ['reviews']),
    ...mapState('productClient', ['show']),
  },
  asyncData: async ({ $axios, $cookies, error, params }) => {
    try {
      let dataParams = {
        idProduct: params.slug,
        idUser: $cookies.get('_user') || {}
      }
      const { data: jobDetail } = await $axios.get(`/api/jobs/${dataParams.idProduct}`)
      const review = jobDetail.product.reviews
      let idCompany = jobDetail.product.user_id
      const { user: user } = await $axios.$get(`/api/users/${idCompany}`)
      const { data: users } = await $axios.get(`/api/users`)
      const { data: jobsRelated } = await $axios.get(`/api/jobs?idUser=${idCompany}&id=${dataParams.idProduct}`);
      return { user, users, jobDetail, dataParams, jobsRelated, review }
    } catch (e) {
      error({
        statusCode: 404, message: ''
      });
    }
  },
  methods: {
    loadMore() {
      if (this.length > this.review.length) return;
      this.length = this.length + 4;
    },
    collapseTo() {
      this.length = 4;
    },
    async setRating() {
      let params = this.dataParams
      this.ratings.user_id = params.idUser.id
      this.ratings.product_id = params.idProduct
      try {
        if (!params.idUser.id || params.idUser.id == params.idProduct) {
          if (confirm('Bạn cần đăng nhập để đánh giá ?')) {
            this.$router.push({ path: `/login` })
          }
        } else {
          const comment_ranting = (await this.$store.dispatch('review/getAll', params)).data.reviewRating
          if (!comment_ranting) {
            if (this.ratings.rating) {
              this.ratings.parent = 1
              await this.$store.dispatch('review/create', { idProduct: params.idProduct, data: this.ratings })
              this.review = (await this.$store.dispatch('productClient/getProductId', params.idProduct)).data.product.reviews
            } else {
              this.ratings.parent = 0
              await this.$store.dispatch('review/create', { idProduct: params.idProduct, data: this.ratings })
              this.review = (await this.$store.dispatch('productClient/getProductId', params.idProduct)).data.product.reviews
            }
          } else {
            this.ratings.parent = 0
            this.ratings.rating = null
            await this.$store.dispatch('review/create', { idProduct: params.idProduct, data: this.ratings })
            this.review = (await this.$store.dispatch('productClient/getProductId', params.idProduct)).data.product.reviews
          }
        }
      } catch (error) {
        this.errors = this.$mixError(error)
      }
    },
    async Delete($id) {
      if (confirm('Bạn có chắc chắn muốn xóa không ?')) {
        await this.$store.dispatch('review/remove', $id)
        this.review = (await this.$store.dispatch('productClient/getProductId', this.$route.params.slug)).data.product.reviews
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

    convertTime(date) {
      return new Date(Number(date)).toLocaleDateString("vi-VN");
    }
  },
}
</script>

<style scoped lang="scss">
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

.img {
  height: 40px;
  width: 40px;
  border-radius: 50%;
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

.brandname {
  font-size: 1.1rem;
  font-weight: 700;
  margin: 0;
}

.block__title {
  font-size: 1.3rem;
  font-weight: 700;
  margin: 1em 0.5em;
}

aside {
  padding: 1em 0.5em;
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

.comment {
  textarea {
    width: 100%;
    height: 80px;
    border: 1px solid #f1f1f1;
    border-radius: 10px;
  }
}

main {
  margin: 3em 0;
}

.box {
  margin: 2em 0;
  padding: 1em;

  p {
    font-size: 0.9rem;
    color: #4e4d4d;
    line-height: 1.2rem;
  }

  ul {
    padding: 0;
    list-style: none;

    li {
      display: flex;
      justify-content: space-between;
    }
  }

  &__button {
    padding: 0.5em;
    display: block;
    width: 100%;
    border-radius: 20px;
    border: 2px solid #000;
    text-align: center;
    color: #000;
    text-decoration: none;
    font-weight: 700;
    box-sizing: border-box;
  }
}

.content {
  background-color: #fff;
  padding: 2em;
  border-radius: 20px;
  margin-bottom: 2em;

  &__title {
    display: flex;
    justify-content: space-between;
    margin-bottom: 1em;

    h1 {
      font-size: 1.3rem;
      font-weight: 600;
    }
  }
}

.aplly {
  display: flex;
  flex-direction: column;
  align-items: center;

  button {
    padding: 0.4em 4em;
    margin-bottom: 0.3em;
    border-radius: 20px;
    border: 2px solid #455964;
    color: #ffffff;
    font-weight: 600;
    background: #455964;
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
    width: 75px;
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
</style>
