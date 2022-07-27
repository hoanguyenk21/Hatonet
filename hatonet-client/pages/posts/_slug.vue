<template>
  <main>
    <div class="block">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-9">
            <article>
              <h3 class="title">{{ posts.title }}</h3>
              <ul class="post-meta">
                <li>
                  <nuxt-link :to="{ path: `taxonomy`, query: { id: posts.taxonomy.id } }">
                    <span>
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-folder" viewBox="0 0 16 16">
                        <path
                          d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z" />
                      </svg>
                    </span>
                    <span>{{ posts.taxonomy.title }}</span>
                  </nuxt-link>
                </li>
                <li>
                  <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                      class="bi bi-calendar-event" viewBox="0 0 16 16">
                      <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z" />
                      <path
                        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                    </svg></span>
                  <span v-text="posts.created_at"> </span>
                </li>
                <li>
                  <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye"
                      viewBox="0 0 16 16">
                      <path
                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                      <path
                        d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                    </svg>
                  </span>
                  <span> {{ posts.view }} Views</span>
                </li>
              </ul>
              <div name="description" v-text="posts.description"></div>
              <div>
                <ul class="tags">
                  <li>
                    <nuxt-link :to="{ path: `term`, query: { id: posts.term.id } }"><i class="ti ti-tag"></i> {{
                        posts.term.title
                    }} </nuxt-link>
                  </li>
                </ul>
              </div>
            </article>
            <aside>
              <h4 class="block-title">Có thể bạn quan tâm</h4>
              <section-related-news :datapost="datapost" />
            </aside>
          </div>
          <div class="col-12 col-md-3">
            <widget-category :categories="categories" />
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import WidgetCategory from '@/components/client/WidgetCategory.vue'
import SectionRelatedNews from '@/components/client/SectionRelatedNews.vue'
export default {
  asyncData: async ({ $axios, params }) => {
    try {
      const { data: posts } = await $axios.get(`/api/post/${params.slug}`);
      let idTaxonomy = posts.taxonomy_id
      const { data: datapost } = await $axios.get(`/api/post?idTaxonomy=${idTaxonomy}&id=${params.slug}`);
      const { data: categories } = await $axios.get(`/api/category`);
      return { posts, datapost, categories }
    } catch (e) {
        
    }
  },
  components: { WidgetCategory, SectionRelatedNews },

  methods: {
    // view() {
    //   this.$axios.get('/api/admin/posts/update-view/' + this.itemId).then((response) => {
    //   });
    // },
  }
}
</script>

<style scoped lang="scss">
.block {
  padding: 3em 0;
}

.post-meta {
  display: flex;
  list-style: none;
  border: 1px solid #f1f1f1;
  padding: 0.8em 2em;
  border-radius: 35px;
  background: #f1f1f1;
  font-size: 0.9rem;

  li {
    margin-right: 1em;
    color: #455a64;
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 0.9rem;
  }

  a {
    text-decoration: none;
    color: #455a64;
  }
}

.tags {
  margin: 1em 0;
  padding: 0;
  list-style: none;

  li {
    background: #f1f1f1;
    display: inline-block;
    padding: 0em 1.4em;
    font-size: 0.8em;
    border-radius: 30px;
    margin-right: 1em;
  }

  a {
    text-decoration: none;
    color: #455a64;
  }
}

.block {
  &--hot {
    background-color: #fff;

    .aside {
      background-color: #f2f3f7;
    }

    .box {
      border: 2px solid #253236;
    }
  }
}

article {
  font-size: 1rem;
  line-height: 1.6em;
  color: #455964;
}

.title {
  font-size: 1.6rem;
  margin: 0.5em 0em;
  font-weight: 800;
}

.block-title {
  font-size: 1.3rem;
  font-weight: 700;
  margin: 1.5em 0.5em;
}

.box {
  box-sizing: border-box;
  border-radius: 20px;
  margin-bottom: 1em;
  display: flex;

  &__image {
    width: 280px;
  }

  &__content {
    padding: 1em;
  }

  img {
    width: 100%;
    border-radius: 15px;
  }

  &--related {
    flex-direction: column;
  }
}

article {
  padding: 1em 2em;
  background-color: #fff;
  border-radius: 20px;
  margin-bottom: 1em;
}
</style>
