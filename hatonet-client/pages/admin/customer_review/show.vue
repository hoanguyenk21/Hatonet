<template>
  <div class="row">
    <div class="mb-3">
      <nuxt-link to="/admin/customer_review" class="btn float-right"
        >Quay lại</nuxt-link
      >
    </div>
    <div class="col-12">
      <div class="card row p-2">
        <div class="card-header">
          <h2>Chi tiết</h2>
        </div>
        <div class="col-12 d-flex align-items-center mt-3 mb-3"></div>
        <div class="col-6">
          <div class="mb-3">
            <label class="form-label">Name</label>
            <span>{{ show.name }}</span>
          </div>

          <div class="mb-3">
            <label class="form-label">Phone</label>
            <span>{{ show.phone }}</span>
          </div>
        </div>
        <div class="col-6">
          <div class="mb-3">
            <label class="form-label">Email</label>
            <span>{{ show.email }}</span>
          </div>
          <div class="mb-3">
            <label class="form-label">Nội dung</label>
            <span>{{ show.message }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'
import Paginate from '@/components/Paginate.vue'
import StatusLabel from '@/components/StatusLabel.vue'
import { baseUrl } from '@/env/env.development'
import SectionImage from '../../../components/client/SectionImage.vue'
export default {
  components: { Paginate, StatusLabel, SectionImage },
  name: 'AdminAreaAccount',
  layout: 'admin.root',

  data() {
    return {
      baseUrl: baseUrl,
    }
  },

  computed: {
    ...mapState('customerReview', ['show']),
  },

  async fetch({ store, route }) {
    try {
      let { id } = route.query
      await store.dispatch('customerReview/getId', id)
    } catch (error) {
      this.$mixError(error)
    }
  },

  methods: {},
}
</script>

<style lang="scss" scoped>
.float-right {
  float: right;
}
.card {
  flex-direction: unset;
  .form-control {
    background: transparent !important;
  }
}
.title {
  p {
    letter-spacing: 2px;
    color: turquoise;
  }
}
img {
  width: 80px;
  height: 80px;
  border-radius: 50%;
}
</style>
