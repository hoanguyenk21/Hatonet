<template>
  <section>
    <div class="row">
      <div class="col-12 col-md-8 col-xl-8">
        <div class="card">
          <div class="card-body p-2">
            <div class="mb-3">
              <label class="form-label">Tiêu đề</label>
              <input type="text" class="form-control" v-model="post.title" />
            </div>
            <div class="mb-3">
              <label class="form-label">Đường dẫn</label>
              <input type="text" class="form-control" v-model="post.slug" />
            </div>
            <div class="mb-3 editor">
              <label class="form-label">
                <span>Nội dung</span>
              </label>
              <client-only>
                <VueEditor
                  v-model="post.content"
                  :editor-toolbar="customToolbar"
                />
              </client-only>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-4 col-xl-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="mb-3">
              <button class="btn btn-dark btn-block">Cập nhật</button>
               <button class="btn btn-warning btn-block">Xoá bài viết</button>
            </div>
            <div class="mb-3">
              <label class="form-label">Danh mục</label>
              <v-select-tree
                v-model="post.category_id"
                :multiple="false"
                label="title"
                :options="category.items"
              >
              </v-select-tree>
            </div>
            <div class="mb-3">
              <label class="form-label">Thẻ</label>
              <v-select-tree
                v-model="post.tag_id"
                :multiple="true"
                :options="tags"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { mapState } from 'vuex'

export default {
  name: 'AdminAreaPost',
  layout: 'admin.root',
  computed: mapState(['category']),
  data: () => ({
    customToolbar: [
      ['bold', 'italic', 'underline'],
      [{ list: 'ordered' }, { list: 'bullet' }],
      ['image'],
    ],
    post: {},
    tags: [],
  }),
  async fetch({ store }) {
    await store.dispatch('category/getAll')
  },
  methods: {
    nextPage: async function (paged) {
      // let resp = await this.$axios.get(`/api/accounts?page=${paged}`)
      // this.account = resp.data
    },
  },
}
</script>
