<template>
  <div class="block block--news">
    <div class="bg-line">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none">
        <path class="elementor-shape-fill" opacity="0.33"
          d="M473,67.3c-203.9,88.3-263.1-34-320.3,0C66,119.1,0,59.7,0,59.7V0h1000v59.7 c0,0-62.1,26.1-94.9,29.3c-32.8,3.3-62.8-12.3-75.8-22.1C806,49.6,745.3,8.7,694.9,4.7S492.4,59,473,67.3z">
        </path>
        <path class="elementor-shape-fill" opacity="0.66"
          d="M734,67.3c-45.5,0-77.2-23.2-129.1-39.1c-28.6-8.7-150.3-10.1-254,39.1 s-91.7-34.4-149.2,0C115.7,118.3,0,39.8,0,39.8V0h1000v36.5c0,0-28.2-18.5-92.1-18.5C810.2,18.1,775.7,67.3,734,67.3z">
        </path>
        <path class="elementor-shape-fill"
          d="M766.1,28.9c-200-57.5-266,65.5-395.1,19.5C242,1.8,242,5.4,184.8,20.6C128,35.8,132.3,44.9,89.9,52.5C28.6,63.7,0,0,0,0 h1000c0,0-9.9,40.9-83.6,48.1S829.6,47,766.1,28.9z">
        </path>
      </svg>
    </div>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12 col-md-6">
          <div class="news">
            <div v-for="post in posts.data.slice(0, 4)" :key="post.id" class="news-item">
              <div class="news-item__image">
                <nuxt-link :to="{ path: `/posts/${post.id}` }">
                  <SectionImage class="img" :src="baseUrl + post.image" />
                </nuxt-link>
              </div>
              <div class="news-item__title">
                <nuxt-link :to="{ path: `/posts/${post.id}` }">{{ post.title }}</nuxt-link>
              </div>
              <div class="news-item__bottom">
                <span><i class="ti ti-calendar-event"></i>{{ post.created_at }}</span>
                <div>
                  <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye"
                      viewBox="0 0 16 16">
                      <path
                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                      <path
                        d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                    </svg>
                  </span>
                  <span> {{ post.view }} Views</span>
                </div>
                <nuxt-link :to="{ path: `/posts/${post.id}` }"> <i class="ti ti-arrow-right"></i>
                </nuxt-link>
              </div>
            </div> 
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="bg-send">
            <img src="@/assets/images/bg-fly.svg" />
          </div>
          <h3>Tin tức từ <span>HATONET</span></h3>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Repellendus, vero. Lorem ipsum dolor sit amet consectetur,
            adipisicing elit. Quia atque nam quidem, maxime repellendus odit
            nobis a, iure explicabo iusto fuga tempora inventore tenetur dolores
            sequi odio possimus, quasi velit!
          </p>
          <validation-observer v-slot="{ valid, handleSubmit }">
            <div class="follow">
              <div class="follow__label">Đăng ký nhận tin sớm nhất</div>
              <div class="follow__mail">
                <validation-provider v-slot="{ errors }" rules="required|email">
                  <input class="email" v-model="messageData.email" placeholder="Vui lòng nhập Email" />
                  <span class="message">{{ errors[0] }}</span>
                </validation-provider>
                <button @click="handleSubmit(onSubmit(valid))"><i class="ti ti-brand-telegram"></i></button>
              </div>
            </div>
          </validation-observer>

        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'
import { baseUrl } from '@/env/env.development.js'
import SectionImage from '../../components/client/SectionImage.vue'
export default {
  props: [
    "posts"
  ],
  components: { SectionImage },
  computed: {
    ...mapState('mailClient', ['recived']),
  },
  data: function () {
    return {
      messageData: {},
      baseUrl: baseUrl,
      limit: 4,
      error: '',
    }
  },
  methods: {
    async onSubmit() {
      try {
        await this.$store.dispatch('mailClient/MailRecived', this.messageData)
        this.$toast.success('Gửi thành công!')
      } catch (error) {
        this.$toast.error('Gửi thất bại!')
      }
    },
  },
}
</script>

<style scoped lang="scss">
.follow__mail {
  position: relative;
}

.message {
  color: red;
  margin-left: 14px;
  position: absolute;
  /* bottom: 121px; */
  top: 50px;
  left: 0;
  clear: both;
  z-index: 99999;
}

.follow__mail .email {
  // /* width: 100%; */
  width: 300px;
  height: 45px;
  border: 1px solid #f1f1f1;
  border-radius: 35px;
  padding: 3px 10px;
}

.news {
  display: flex;
  gap: 20px;
  flex-wrap: wrap;
  align-items: flex-start;
  margin-bottom: 2em;

  img {
    width: 100%;
  }

  a {
    text-decoration: none;
    font-weight: 600;
    color: #455a64;
    font-size: 1rem;
    letter-spacing: 0.5px;
  }

  .news-item {
    overflow: hidden;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0.1px 4px 5px rgb(0 0 0 / 3%);

    &:nth-child(2n + 0) {
      margin-top: 35px;
    }

    &__title {
      padding: 0.3em 1em;
    }

    &__bottom {
      padding: 0.3em 1em 1em;
      display: flex;
      justify-content: space-between;
      font-size: 0.8rem;
    }
  }

  @media (min-width: 1028px) {
    .news-item {
      width: 250px;
    }

    input[data-v-27b30d6f] {
      // /* width: 100%; */
      width: 100%;
      height: 45px;
      border: 1px solid #f1f1f1;
      border-radius: 35px;
      padding: 3px 10px;
    }
  }

  @media (min-width: 320px) {
    input[data-v-27b30d6f] {
      // /* width: 100%; */
      width: 100% !important;
      height: 45px;
      border: 1px solid #f1f1f1;
      border-radius: 35px;
      padding: 3px 10px;
    }
  }
}

.block {
  padding: 3em 0;
  position: relative;
  padding: 12em 0 6em;
  background-color: #fff;

  img {
    width: 100%;
  }
}

.bg-line {
  svg {
    position: absolute;
    fill: #f2f3f7;
    top: 0;
  }
}

h3 {
  font-size: 2rem;

  span {
    font-weight: bold;
  }
}

.news-item {
  a {
    font-size: 1rem;
    text-decoration: none;
    font-weight: 700;
    color: #000;
  }
}

.follow {
  margin: 4em 0px;

  &__label {
    margin-bottom: 0.5em;
    text-transform: uppercase;
    font-size: 0.8rem;
    font-weight: 700;
    padding: 0 0.3em;
  }

  &__mail {
    display: flex;
    gap: 15px;

    button {
      height: 45px;
      width: 45px;
      border: none;
      background: #ea530a;
      border-radius: 100%;
      color: #fff;
      padding: 0.3em;
      font-size: 1.4rem;

      &:hover {
        background: #ba4003;
        cursor: pointer;
      }
    }
  }
}

input {
  width: 100%;
  max-width: 350px;
  height: 45px;
  border: 1px solid #f1f1f1;
  border-radius: 35px;
  padding: 3px 10px;
}

.bg-send {
  padding: 1em;
  width: 65%;
}
</style>
