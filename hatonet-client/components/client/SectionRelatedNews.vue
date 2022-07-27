<template>
  <div class="news">
    <div class="row">
      <div class="col-12 col-md-4" v-for="post in datapost.slice(0, 3)" :key="post.id">
        <div class="news-item">
          <div class="news-item__image">
            <nuxt-link :to="{ path: `/posts/${post.id}`, query: { id: post.id } }">
            <SectionImage   class="img" :src="baseUrl + post.image"  />
            </nuxt-link>
          </div>
          <div class="news-item__title">
            <nuxt-link :to="{ path: `/posts/${post.id}`, query: { id: post.id } }">{{
                post.title
            }}
            </nuxt-link>
          </div>
          <div class="news-item__bottom">
            <span><i class="ti ti-calendar-event"></i>{{ post.created_at }}</span>
            <div>
              <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye"
                  viewBox="0 0 16 16">
                  <path
                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                </svg>
              </span>
              <span> {{ post.view }} Views</span>
            </div>
            <nuxt-link :to="{ path: `/posts/${post.id}`, query: { id: post.id } }"> <i
                class="ti ti-arrow-right"></i>
            </nuxt-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {baseUrl} from '@/env/env.development.js'
import SectionImage from '../../components/client/SectionImage.vue'
export default {   
  components: {SectionImage},
    data: function () {
    return {
      baseUrl: baseUrl,
      limit:3
    }
  },
  props:[
    "datapost",
  ],

}
</script>

<style scoped lang="scss">
.news {
  gap: 20px;
  flex-wrap: wrap;
  align-items: flex-start;

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
}
</style>