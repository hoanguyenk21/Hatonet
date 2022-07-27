<template>
  <div class="block">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-5">
          <img src="@/assets/images/bg_winner.svg" />
        </div>
        <div class="col-12 col-md-12 col-lg-7">
          <div class="block__header">
            <h2>Top công ty Onsite</h2>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero,
              cum!
            </p>
          </div>

          <section class="company">
            <div class="company-item" v-for="user in company" :key="user.id">
              <nuxt-link class="company-item__image" :to="{ path: `/company/${user.id}` }">
                <SectionImage class="img" :src="baseUrl + user.avatar" />
              </nuxt-link>
              <div to="/" class="company-item__content">
                <nuxt-link :to="{ path: `/company/${user.id}` }" class="title">
                  <h5 class="title">{{ user.name }}</h5>
                </nuxt-link>

                <ul class="meta">
                  <li v-for="proMeta in user.meta" :key="proMeta.id">
                    <i class="ti ti-map-pin" v-if="proMeta.meta_key == '_address'">{{ proMeta.meta_value }}</i>
                  </li>
                  <li>
                    <i class="ti ti-briefcase">{{ user.count_product || 0 }}</i>
                  </li>
                  <li>
                    <i class="ti ti-message">{{ user.count_commnet || 0 }}</i>
                  </li>
                  <li><i class="ti ti-star"></i>{{ user.rating || 0 }}/5</li>
                </ul>
              </div>
              <div to="/" class="company-item__redirect">
                <div class="success">
                  <!-- <small>Hoàn thành</small>
                  <span>100%</span> -->
                </div>
                <nuxt-link :to="{ path: `/company/${user.id}` }">
                  <i class="ti ti-arrow-right"></i>
                </nuxt-link>
              </div>
            </div>
          </section>
        </div>
      </div>
      <div class="block__header">
        <h2>Danh sách công ty nổi bật</h2>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero,
          cum!
        </p>
      </div>
      <div class="row">
        <div class="col-12 col-md-12">
          <div class="jobs">
            <div class="topCompany-item" v-for="user in users.slice(0, 9)" :key="user.id">
              <nuxt-link class="company-item__image" :to="{ path: `/company/${user.id}` }">
                <SectionImage class="img" :src="baseUrl + user.avatar" />
              </nuxt-link>
              <div to="/" class="company-item__content">
                <nuxt-link :to="{ path: `/company/${user.id}` }" class="title">
                  <h5 class="title">{{ user.name }}</h5>
                </nuxt-link>

                <ul class="meta">
                  <li v-for="proMeta in user.meta" :key="proMeta.id">
                    <i class="ti ti-map-pin" v-if="proMeta.meta_key == '_address'">{{ proMeta.meta_value }}</i>
                  </li>
                </ul>
              </div>
              <div to="/" class="company-item__redirect">
                <div class="success">
                  <!-- <small>Hoàn thành</small>
                  <span>100%</span> -->
                </div>
                <nuxt-link :to="{ path: `/company/${user.id}` }">
                  <i class="ti ti-arrow-right"></i>
                </nuxt-link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import LoadMore from '@/components/LoadMore.vue'
import { baseUrl } from '@/env/env.development.js'
import SectionImage from '../../components/client/SectionImage.vue'
export default {
  components: { LoadMore, SectionImage },
  props: ['users'],
  data: function () {
    return {
      baseUrl: baseUrl,
      length: 4,
      limit: 9,
    }
  },
  computed: {
    company() {
      return this.users.filter(user => user.roles == 'company').slice(0, this.length)
    },
  },
  methods: {
    companiesVisible() {
      if (this.length > this.users.length) return
      this.length = this.length + 4
    },
  },
}
</script>


<style scoped lang="scss">
.block {
  background: #fff;
  padding: 3em 0;

  &__header {
    h2 {
      font-size: 2rem;
      font-weight: 700;
    }

    p {
      font-size: 1.3rem;
      font-weight: 100;
    }
  }
}

.jobs {
  display: grid;
  grid-template-columns: 1fr;

  gap: 15px;

  &--list {
    grid-template-columns: 1fr;

    .job-item {
      background-color: #ebebeb;
      box-shadow: none;
    }
  }

  @media (min-width: 769px) {
    grid-template-columns: auto auto auto;
  }
}

.topCompany-item {
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
      color: #253235;
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
    display: none;

    i {
      font-size: 1rem;
    }

    li {
      margin-right: 0.6em;
    }
  }

  @media (min-width: 1204px) {
    .meta {
      display: flex;
    }
  }
}

.company-item {
  border-radius: 15px;
  padding: 0.5em 1em;
  border: 2px solid #fff;
  margin-bottom: 1em;

  a {
    font-size: 1.1rem;
    text-decoration: none;
    font-weight: 700;
    color: #000;
  }

  &:first-child {
    background: #455964;
    border: 2px solid #455964;

    a {
      color: #fff;
    }

    .meta {
      color: #fff;
    }

    .success {
      small {
        color: #fff;
      }

      span {
        color: #fff;
      }
    }
  }

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

    .success {
      text-align: right;

      small {
        color: #455964;
        font-weight: 200;
      }

      span {
        display: block;
        font-size: 1.3rem;
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
    font-size: 0.9rem;

    i {
      font-size: 1rem;
    }

    li {
      margin-right: 0.6em;
    }
  }
}
</style>
