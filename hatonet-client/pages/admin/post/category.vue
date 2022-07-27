<template>
  <section>
    <div class="row">
            <div class="mb-3">
              <button class="btn btn-dark btn-block" @click="back()">
                Quay lại
              </button>
            </div>
      <div class="col-6 col-md-6 col-xl-4">
        <div class="card">
          <div class="card-body">
            <form @submit.prevent="onAddCategory">
              <div class="mb-3">
                <label class="form-label required">Tiêu đề</label>
                <input
                  type="text"
                  class="form-control"
                  placeholder="Tiêu đề"
                  v-model="categories.title"
                  :class="[{ 'is-invalid': errors.title }]"
                />
                <span class="text-danger alertSpan" v-if="errors && errors.title">
                  {{ errors.title[0] }}
                </span>
              </div>
              <div class="mb-3">
                <label class="form-label required">Đường dẫn</label>
                <input
                  type="text"
                  class="form-control"
                  placeholder="Đường dẫn"
                  v-model="categories.slug"
                  :class="[{ 'is-invalid': errors.slug }]"
                />
                <span class="text-danger alertSpan" v-if="errors && errors.slug">
                  {{ errors.slug[0] }}
                </span>
              </div>
              <div class="mb-3">
                <label class="form-label">Nội dung</label>
                <input
                  type="text"
                  class="form-control"
                  placeholder="Nội dung"
                  v-model="categories.content"
                  :class="[{ 'is-invalid': errors.content }]"/>
                <span class="text-danger alertSpan" v-if="errors && errors.content">
                  {{ errors.slug[0] }}
                </span>
              </div>
              <div class="mb-3">
                <div class="form-label">Mô tả</div>
                <textarea
                  class="form-control"
                  v-model="categories.description"
                  placeholder="Mô tả"
                  :class="[{ 'is-invalid': errors.description }]"/>
                <span
             class="text-danger alertSpan"
                  v-if="errors && errors.description"
                >
                  {{ errors.slug[0] }}
                </span>
              </div>
              <div class="mb-3">
                <button class="btn btn-primary">Thêm danh mục</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-6 col-xl-8">
        <div class="card">
          <div class="table-responsive">
            <table class="table table-vcenter card-table table-striped">
              <thead>
                <tr>
                  <th>Tiêu đề</th>
                  <th>Số bài viết</th>
                  <th class="w-3">Hành động</th>
                </tr>
              </thead>
              <tbody>
                <template>
                  <tr v-for="categories in categories" :key="categories.id">
                    <td>{{ categories.title }}</td>
                    <td class="text-muted">{{categories.count_taxonomy}}</td>
                    <td>
                      <button
                        class="btn align-text-top"
                        data-bs-boundary="viewport"
                        data-bs-toggle="dropdown"
                        @click="redirectToEditFormPost(categories.id)"
                      >
                        Sửa
                      </button>
                    </td>
                    <td>
                      <button
                        class="btn align-text-top"
                        data-bs-boundary="viewport"
                        data-bs-toggle="dropdown"
                        @click="onDeleteCategory(categories.id)"
                      >
                        xóa
                      </button>
                    </td>
                  </tr>
                </template>
              </tbody>
            </table>
             <div class="card-footer d-flex align-items-center">
            <paginate :total="categories.total" @paginate="nextPage" />
          </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { mapState } from 'vuex'
import Paginate from '@/components/Paginate.vue'
export default {
  name: 'AdminAreaPost',
  layout: 'admin.root',
  components: { Paginate },
  data: () => ({
    errors: {},
    parent_id: '',
  }),
  computed: mapState('category' ,['categories']),
  async fetch({store}) {
    try {
      await store.dispatch('category/getAll')
    } catch (error) {
    console.log(error)
    }
  },
  methods: {
    // create category
    onAddCategory: async function (e) {
      e.preventDefault()
      try {
          const formsData = {
          title: this.categories.title,
          slug: this.categories.slug,
          description: this.categories.description,
          content: this.categories.content,
          type: this.categories.type,
          user_id: this.$cookies.get('_user').id
        }       
          await this.$store.dispatch('category/create' ,formsData)
          await this.$store.dispatch('category/getAll')
          this.$toast.success('Tạo mới thành công !')
      } catch (error) {
        this.errors = this.$mixError(error)
        this.$toast.error('Tạo mới thất bại !')
      }
    },
    async onDeleteCategory($id) {
      if (confirm('Bạn có chắc chắn muốn xóa không ?')) {
        let parent_id = await this.$store.dispatch('category/getById', $id)
        this.parent_id = parent_id.data.parent
        if (this.parent_id == 0) {
          let deleted = await this.$store.dispatch('category/remove', $id)
          if (deleted) {
            await this.$store.dispatch('category/getAll')
            this.$router.push({ path: '/admin/post/category' })
          }
        }else{
            confirm('ban khong the xoa');
        }
      }
    },
        back() {
      this.$router.push({path: '/admin/post'})},
    redirectToEditFormPost(id) {
      this.$router.push({
        path: '/admin/post/edit_category',
        query: { id: id },
      })
    },
    nextPage: async function (paged) {
      let resp = await this.$axios.get(`/api/admin/taxonomies?type=post&page=${paged}`)
      this.categories = resp.data
    },
  },
}
</script>

<style>
.was-validated .admin .form-control:invalid, .admin .form-control.is-invalid ,  .admin .form-select.is-invalid:not([multiple]):not([size]){
  background-image: none;
}
.alertSpan{
  font-size:12px;
  padding-left: 13px;
}
</style>
