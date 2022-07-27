<template>
  <section>
    <div class="row">
      <div class="mb-3">
        <nuxt-link class="btn btn-dark btn-block" to="/admin/page"
          >Quay lại</nuxt-link
        >
      </div>
      <div class="col-12 col-md-8 col-xl-8">
        <div class="card">
          <div class="card-body p-2">
            <div class="mb-3">
              <label class="form-label required">Tiêu đề</label>
              <input
                type="text"
                class="form-control"
                placeholder="Tiêu đề"
                v-model="pages.title"
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
                v-model="pages.slug"
                :class="[{ 'is-invalid': errors.slug }]"
              />
              <span class="text-danger alertSpan" v-if="errors && errors.slug">
                {{ errors.slug[0] }}
              </span>
            </div>
            <div class="mb-3">
              <label class="form-label">Ảnh</label>
              <input
                type="file"
                class="form-control"
                @change="uploadImage($event)"
              />
            </div>
            <div class="mb-3 editor">
              <label class="form-label">
                <span>Mô tả</span>
              </label>
              <!-- <client-only>
                <VueEditor
                  v-model="pages.description"
                  placeholder="Mô tả"
                  :editor-toolbar="customToolbar"     
                  :class="[{ 'is-invalid': errors.title }]"/>
              </client-only> -->
              <textarea
                class="form-control"
                name=""
                id=""
                cols="95"
                rows="5"
                v-model="pages.description"
              ></textarea>
              <span
                class="text-danger alertSpan"
                v-if="errors && errors.description"
              >
                {{ errors.description[0] }}
              </span>
            </div>
            <div class="mb-3 editor">
              <label class="form-label">
                <span>Nội dung</span>
              </label>
              <!-- <client-only>
                <VueEditor
                  v-model="pages.content"
                  placeholder="Nội dung"
                     :editor-toolbar="customToolbar"     
                />
              </client-only>
              <span class="text-danger alertSpan" v-if="errors && errors.content">
                {{ errors.content[0] }}
              </span> -->
              <textarea
                class="form-control"
                name=""
                id=""
                cols="95"
                rows="5"
                v-model="pages.content"
              ></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-4 col-xl-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="mb-3">
              <button class="btn btn-dark btn-block" @click="addPage">
                Tạo mới
              </button>
            </div>
            <div class="mb-3">
              <div class="form-group">
                <label class="form-label">Thẻ</label>
                <select
                  class="form-select"
                  v-model="pages.term_id"
                  :class="[{ 'is-invalid': errors.term_id }]"
                >
                  <option
                    v-for="(term, index) in items"
                    v-bind:key="index"
                    :value="term.id"
                    :selected="term.id"
                  >
                    {{ term.title }}
                  </option>
                </select>
              </div>
              <span
                class="text-danger alertSpan"
                v-if="errors && errors.term_id"
              >
                {{ errors.term_id[0] }}
              </span>
            </div>
            <div class="mb-3">
              <div class="form-group mb-3">
                <label class="form-label">Danh mục</label>
                <select
                  class="form-select"
                  v-model="pages.taxonomy_id"
                  :class="[{ 'is-invalid': errors.taxonomy_id }]"
                >
                  <option
                    v-for="(taxonomy, index) in categories"
                    v-bind:key="index"
                    :value="taxonomy.id"
                    :selected="taxonomy.id"
                  >
                    {{ taxonomy.title }}
                  </option>
                </select>
              </div>
              <span
                class="text-danger alertSpan"
                v-if="errors && errors.taxonomy_id"
              >
                {{ errors.taxonomy_id[0] }}
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { mapState } from 'vuex'
import { STATUS } from '../../../constants/common'
export default {
  name: 'AdminAreaPost',
  layout: 'admin.root',
  computed: {
    ...mapState('category', ['categories']),
    ...mapState('term', ['items']),
  },
  data: () => ({
    customToolbar: [
      ['bold', 'italic', 'underline'],
      [{ list: 'ordered' }, { list: 'bullet' }],
      ['image'],
    ],
    pages: {},
    errors: {},
    options: {
      status: STATUS,
    },
    image: null,
  }),
  async fetch() {
    try {
      await this.$store.dispatch('category/getAll')
      await this.$store.dispatch('term/getAll')
    } catch (error) {
      this.$mixError(error)
    }
  },
  methods: {
    async addPage() {
      try {
        this.pages.user_id = this.$cookies.get('_user').id
        this.pages.type = 'page'
        this.pages.status = 'active'
        await this.$store.dispatch('page/createPage', this.pages)
        this.$router.push({ path: `/admin/page` })
        this.$toast.success('Tạo mới thành công !')
      } catch (error) {
        this.errors = this.$mixError(error)
        this.$toast.error('Tạo mới thất bại !')
      }
    },
    uploadImage(e) {
      this.pages.image = e.target.files[0]
    },
  },
}
</script>

<style scoped lang="scss">
.was-validated .admin .form-control:invalid,
.admin .form-control.is-invalid,
.admin .form-select.is-invalid:not([multiple]):not([size]) {
  background-image: none;
}
.alertSpan {
  font-size: 12px;
  padding-left: 13px;
}
.editor .quillWrapper .ql-snow.ql-toolbar button svg {
  svg {
    width: 15px;
    height: 15px;
  }
}
</style>
