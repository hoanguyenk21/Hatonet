<template>
  <section>
    <div class="row">
      <div class="col-6 col-md-6 col-xl-6">
        <div class="mb-3">
          <label class="form-label required">Tiêu đề</label>
          <input
            type="text"
            class="form-control"
            placeholder="Tên danh mục"
            v-model="category.title"
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
            v-model="category.slug"
            :class="[{ 'is-invalid': errors.slug }]"
          />
          <span class="text-danger alertSpan" v-if="errors && errors.slug">
            {{ errors.slug[0] }}
          </span>
        </div>
        <div class="mb-3">
          <div class="form-label">content</div>
          <input
            type="text"
            class="form-control"
            placeholder="Content"
            v-model="category.content"
            :class="[{ 'is-invalid': errors.content }]"
          />
          <span class="text-danger alertSpan" v-if="errors && errors.content">
            {{ errors.content[0] }}
          </span>
        </div>
        <div class="mb-3 editor">
          <label class="form-label">
            <span>Nội dung</span>
          </label>
          <textarea
            class="form-control"
            v-model="category.description"
            placeholder="Mô tả"
            :class="[{ 'is-invalid': errors.description }]"
          />
          <span
            class="text-danger alertSpan"
            v-if="errors && errors.description"
          >
            {{ errors.description[0] }}
          </span>
        </div>
        <div class="mb-3">
          <button class="btn btn-primary" @click="submitUpdate">
            Lưu danh mục
          </button>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { mapState, mapActions } from 'vuex'
export default {
  name: 'AdminAreaPost',
  layout: 'admin.root',
  data: () => ({
    customToolbar: [
      ['bold', 'italic', 'underline'],
      [{ list: 'ordered' }, { list: 'bullet' }],
      ['image'],
    ],
    errors: '',
  }),
  computed: {
    ...mapState('category', ['category']),
  },
  async fetch({store , route}) {
    let {id} = route.query
    await store.dispatch('category/getById', id)
  },
  methods: {
    async submitUpdate() {
      try {
        await this.$store.dispatch('category/update', this.category);
        this.$toast.success('Cập nhật thành công !')
        this.$router.push({ path: `/admin/post/category` })
      } catch (error) {
        this.errors = this.$mixError(error)
         this.$toast.error('Cập nhật thất bại !')
      }
    },
    nextPage: async function (paged) {
      // let resp = await this.$axios.get(`/api/accounts?page=${paged}`)
      // this.account = resp.data
    },
  },
}
</script>

<style>
.was-validated .admin .form-control:invalid,
.admin .form-control.is-invalid,
.admin .form-select.is-invalid:not([multiple]):not([size]) {
  background-image: none;
}
.alertSpan {
  font-size: 12px;
  padding-left: 13px;
}
</style>
