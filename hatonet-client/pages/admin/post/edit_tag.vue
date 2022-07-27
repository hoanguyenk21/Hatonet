<template>
  <section>
    <div class="row">
      <div class="col-6 col-md-6 col-xl-6">
        <div class="mb-3 ">
          <label class="form-label required">Tên thẻ</label>
          <input v-model="item.title" type="text" class="form-control" name="example-text-input" placeholder="Tên thẻ"
            :class="[{ 'is-invalid': errors.title }]" />
          <span class="text-danger alertSpan" v-if="errors && errors.title">
            {{ errors.title[0] }}
          </span>
        </div>
        <div class="mb-3 ">
          <label class="form-label required">Đường dẫn</label>
          <input v-model="item.slug" disabled type="text" class="form-control" name="example-text-input" placeholder="Đường dẫn"
            :class="[{ 'is-invalid': errors.slug }]" />
          <span class="text-danger alertSpan" v-if="errors && errors.slug">
            {{ errors.slug[0] }}
          </span>
        </div>
        <div class="mb-3 ">
          <label class="form-label required">Type</label>
          <input v-model="item.type" type="text" class="form-control" name="example-text-input" placeholder="Type"
            :class="[{ 'is-invalid': errors.type }]" />
          <span class="text-danger alertSpan" v-if="errors && errors.type">
            {{ errors.type[0] }}
          </span>
        </div>
        <div class="mb-3 ">

          <label class="form-label">Content</label>
          <input v-model="item.content" type="text" class="form-control" name="example-text-input" placeholder="Content"
            :class="[{ 'is-invalid': errors.content }]" />
          <span class="text-danger alertSpan" v-if="errors && errors.content">
            {{ errors.content[0] }}
          </span>
        </div>


        <div class="mb-3">
          <label class="form-label">Mô tả </label>
          <textarea v-model="item.description" class="form-control" name="example-textarea-input" rows="3"
            placeholder="Mô tả" :class="[{ 'is-invalid': errors.description }]" />
          <span class="text-danger alertSpan" v-if="errors && errors.description">
            {{ errors.description[0] }}
          </span>
        </div>
        <div class="row">
          <div class="col-md-4">
            <nuxt-link to="/admin/post/tag" class="back"> <button class="btn btn-primary btn-l">Quay lại</button>
            </nuxt-link>
          </div>
          <div class="col-md-4 ms-auto"> <button class="btn btn-primary btn-r" @click="submitUpdate">Lưu thẻ</button>
          </div>
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
    terms: {},
    errors: {},
    itemId: null,
  }),
  computed: {
    ...mapState('term', ['item']),
  },
  async fetch({ store, route }) {
    const termId = await route.query.id
    await store.dispatch('term/getById', termId)

  },
  methods: {
    async submitUpdate() {
      try {
        const formsData = {
          id: this.item.id,
          title: this.item.title,
          description: this.item.description,
          content: this.item.content,
          type: this.item.type,
          slug: this.item.slug,
        }
        await this.$store.dispatch('term/update', formsData)
        this.$router.push({ path: `/admin/post/tag` })
        this.$toast.success('Cập nhật thẻ thành công!')
      }
      catch (error) {
        this.errors = this.$mixError(error)
        this.$toast.error('Cập nhật thẻ không thành công!')
      }
    },
  },
}
</script>
<style>
.back {
  text-decoration: none !important;
}

.btn-l {
  background-color: black !important;
}

.btn-r {
  background-color: black !important;
  float: right;
}

.was-validated .admin .form-control:invalid,
.admin .form-control.is-invalid,
.admin .form-select.is-invalid:not([multiple]):not([size]) {
  background-image: none;
}

.alertSpan {
  font-size: 12px;
  padding-left: 13px;
}

.error {
  background-color: #CC0000 !important;
}
</style>
