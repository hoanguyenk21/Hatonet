<template>
  <div class="row">
    <div class="mb-3">
      <nuxt-link to="/admin/account" class="btn float-right">Quay lại</nuxt-link>
    </div>
    <div class="col-12">
      <div class="card row p-2">
        <div class="card-header">
          <h2>Personal Information</h2>
        </div>
        <div class="col-12 d-flex align-items-center mt-3 mb-3">
          <div>
            <SectionImage class="me-2" :src="baseUrl + show.avatar" />
          </div>
          <div class="title">
            <p class="m-0">Avatar</p>
            <h2>{{ show.name }}</h2>
          </div>
        </div>
        <div class="col-6">
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input
              type="text"
              class="form-control"
              v-model="show.name"
              disabled
            />
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input
              type="text"
              class="form-control"
              v-model="show.email"
              disabled
            />
          </div>
          <div class="mb-3">
            <label class="form-label">Phone</label>
            <input
              type="text"
              class="form-control"
              v-model="show.phone"
              disabled
            />
          </div>
        </div>
        <div class="col-6">
          <div class="mb-3">
            <label class="form-label">Roles</label>
            <input
              type="text"
              class="form-control"
              v-model="show.roles"
              disabled
            />
          </div>
          <div class="mb-3">
            <label class="form-label">Status</label>
            <input
              type="text"
              class="form-control"
              v-model="show.status"
              disabled
            />
          </div>
          <div class="mb-3">
            <label class="form-label">_Address</label>
            <div v-for="(meta,index) in show.meta" :key="index">
              <input
                v-if="meta.meta_key == '_address'"
                type="text"
                class="form-control"
                v-model="meta.meta_value"
                disabled
              />
            </div>
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
    ...mapState('account', ['show']),
  },

  async fetch({ store, query }) {
    const id = query.id
    ;(await store.dispatch('account/getAccountId', id)) || {}
  },

  methods: {},
}
</script>

<style lang="scss" scoped>
.float-right{
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
