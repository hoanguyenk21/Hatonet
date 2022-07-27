<template>
  <div class="block block--company">
    <div class="container">
      <div class="block__title">
        <h3>Công ty đang tuyển dụng</h3>
        <p>Danh sách công ty IT được đánh giá tốt nhất đang tuyển dụng</p>
      </div>
      <div class="row">
        <div class="col-md-3" v-for="user  in company " :key="user.id">
          <div class="box">
            <nuxt-link :to="{ path: `/company/${user.id}` }">
              <SectionImage class="img" :src="baseUrl + user.avatar" />
            </nuxt-link>
            <nuxt-link :to="{ path: `/company/${user.id}` }" class="title">
              <h4 class="title">{{ user.name }}</h4>
            </nuxt-link>
            <div>
              <ul class="meta">
                <li>
                  <i class="ti ti-briefcase"></i>{{ user.count_product || 0 }}
                </li>
                <li>
                  <i class="ti ti-message"></i>{{ user.count_commnet || 0 }}
                </li>
                <li><i class="ti ti-star"></i>{{ user.rating || 0 }}/5</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { baseUrl } from '@/env/env.development.js'
import SectionImage from '../../components/client/SectionImage.vue'
export default {
  components: { SectionImage },
  props: ['users'],
  data: function () {
    return {
      baseUrl: baseUrl,
      length: 4,
    }
  },
  computed: {
    company() {
      return this.users.filter(user => user.roles == 'company').slice(0, this.length)
    },
  },
}
</script>

<style scoped lang="scss">
.block {
  padding: 4em 0 6em;

  &__title {
    h3 {
      font-size: 1.8rem;
      font-weight: 900;
      color: #455a64;
    }

    p {
      font-size: 1.4rem;
      line-height: 1.9rem;
      font-weight: 300;
      color: #7e7e7e;
    }

    margin-bottom: 1.3em;
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
  border: 1px solid #f1f1f1;
  margin-bottom: 2em;

  img {
    width: 100%;
  }
}
</style>
