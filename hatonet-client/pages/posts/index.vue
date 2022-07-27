<template>
  <main>
    <div class="block">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-9">
            <div class="title">
              <h3>Tin tức mới nhất</h3>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Deleniti, asperiores?
              </p>
            </div>
            <div>
              <div class="box" v-for="post  in posts.data" :key="post.id">
                <div class="box__image">
                  <nuxt-link :to="{ path: `/posts/${post.id}` }">
                    <img class="img" :src="baseUrl + post.image"
                      @error="$event.target.src = require('@/assets/images/avatar/imagesav.png')" />
                  </nuxt-link>
                </div>
                <div class="box__content">
                  <div class="content">
                    <nuxt-link :to="{ path: `/posts/${post.id}` }" v-if="post.title" v-text="post.title"></nuxt-link>
                    <p v-if="post.description" name="description" v-text="post.description"></p>
                  </div>
                  <div class="meta">
                    <div class="avatar">
                      <div>
                        <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-calendar-event" viewBox="0 0 16 16">
                            <path
                              d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z" />
                            <path
                              d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                          </svg></span>
                        <span>{{ post.created_at }}</span>
                      </div>
                      <div class="avatar__title">
                        <span>
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-eye" viewBox="0 0 16 16">
                            <path
                              d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                            <path
                              d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                          </svg>
                        </span>
                        <span> {{ post.view }} Views</span>
                      </div>
                    </div>
                    <div class="redirect">
                      <nuxt-link :to="{ path: `/posts/${post.id}` }">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                          class="bi bi-arrow-right" viewBox="0 0 16 16">
                          <path fill-rule="evenodd"
                            d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                        </svg>
                      </nuxt-link>
                    </div>
                  </div>
                </div>
              </div>
              <div class="pagination">
                <paginate :total="posts.total" @paginate="paginate" />
              </div>
            </div>
          </div>
          <div class="col-12 col-md-3">
            <aside>
              <widget-category :categories="categories" />
              <widget-ads />
            </aside>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import WidgetCategory from '@/components/client/WidgetCategory.vue'
import WidgetAds from '@/components/client/WidgetAds.vue'
import Paginate from '@/components/Paginate.vue'
import { baseUrl } from '@/env/env.development.js'
import SectionImage from '@/components/client/SectionImage.vue'
export default {
  data: function () {
    return {
      baseUrl: baseUrl,
    }
  },
  components: { SectionImage, Paginate, WidgetCategory, WidgetAds },
  asyncData: async ({ $axios, error }, page = 1) => {
    try {
      const { data: posts } = await $axios.get(`/api/post?page=${page}`)
      const { data: categories } = await $axios.get(`/api/category?page=${page}`);
      return { posts, categories }
    } catch (e) {
      error({
        statusCode: 404, message: ''
      });
    }
  },

  methods: {
    async paginate(page) {
      const posts = (await this.$axios.get(`/api/post?page=${page}`)).data.posts.data
      return { posts }
    },
  }
}
</script>

<style scoped lang="scss">
.meta {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.beutyimg {
  width: 100% !important;
  height: 180px !important;
}

.block {
  padding: 3em 0;

  .title {
    margin-bottom: 2em;

    h3 {
      font-size: 2rem;
      font-weight: 800;
      color: #455a64;
      margin-bottom: 0.3em;
      text-align: center;
    }

    p {
      margin: 0 auto;
      font-size: 1.4rem;
      line-height: 1.9rem;
      font-weight: 300;
      color: #7e7e7e;
      text-align: center;
    }
  }

  &--hot {
    background-color: #fff;

    .aside {
      background-color: #f2f3f7;
      height: 100%;
    }

    .box {
      border: 2px solid #253236;
    }
  }
}

.title {
  font-size: 1.5rem;
  font-weight: 700;
  margin: 0.3em 0 1em;
}

.avatar {
  display: flex;
  align-items: center;
  gap: 10px;

  &__image {
    width: 40px;
    height: 40px;
    overflow: hidden;
    border-radius: 50%;
    border: 2px solid #f1f1f1;
    padding: 0px;
    background: #f1f1f1;

    img {
      height: 80%;
      width: 80%;
    }
  }

  &__title {
    line-height: 1rem;

    a {
      font-size: 0.8rem !important;
      letter-spacing: 0.5px;
    }

    small {
      display: block;
      color: #7e7e7e;
    }
  }
}

.box {
  box-sizing: border-box;
  border-radius: 20px;
  margin-bottom: 2em;
  display: flex;
  background: #fff;

  &__image {
    width: 230px;
    flex: none;
  }

  &__content {
    width: 100%;
    padding: 1em 2em;
    display: flex;
    flex-direction: column;
    justify-content: space-between;

    a {
      font-size: 1.3rem;
      text-decoration: none;
      font-weight: 700;
      color: #455a64;
    }

    p {
      font-size: 1rem;
      color: #455a64;
    }
  }

  img {
    width: 100%;
    border-radius: 20px;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
  }
}
</style>
<style>
.pagination {
  display: flex;
  gap: 10px;
  margin: 3em 0;
  padding-left: 0;
  list-style: none;
  user-select: none;
  width: 100%;
}

.page-item.active .page-link {
  z-index: 3;
  color: #ffffff;
  background-color: #206bc4;
  border-color: #206bc4;
}

.page-link {
  min-width: 0.8rem !important;
  border-radius: 35px;
  text-decoration: none;
  display: inline-block;
  height: 30px;
  width: 30px;
  line-height: 30px;
  text-align: center;
  font-weight: bold;
  background: #f1f1f1;
  color: #222;
}

.page-item.active .page-link {
  background: #f60;
}
</style>
