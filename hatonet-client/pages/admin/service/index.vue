<template>
  <section>
    <div class="row mb-3">
      <div class="col-12">
        <nuxt-link class="btn" to="/admin/service/add">
          <div class="d-flex align-items-center">
            <i class="ti ti-plus"></i> <span>Tạo gói dịch vụ</span>
          </div>
        </nuxt-link>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="row row-cards">
          <div v-for="item in items" :key="item.id" class="col-sm-6 col-lg-3">
            <div class="card card-md h-100">
              <div
                v-if="item.title == 'Premium'"
                class="ribbon ribbon-top ribbon-bookmark bg-green"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="icon icon-filled"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  stroke-width="2"
                  stroke="currentColor"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path
                    d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"
                  ></path>
                </svg>
              </div>
              <div class="card-body text-center">
                <div class="text-uppercase text-muted font-weight-medium">
                  {{ item.title }}
                </div>
                <h3 class="fw-bold my-3 text-decoration-line-through">{{ new Intl.NumberFormat().format(item.price_base) }} VND</h3>
                <h3 class="fw-bold my-3">{{ new Intl.NumberFormat().format(item.price_sale) }} VND</h3>
                <ul class="list-unstyled lh-lg">
                  <!-- <li><strong>3</strong> Users</li> -->
                  <li v-for="(val, index) in item.service_meta" :key="index">

                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="icon me-1 text-success"
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      stroke-width="2"
                      stroke="currentColor"
                      fill="none"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      v-if="val.meta_key == true"
                    >
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M5 12l5 5l10 -10"></path>
                    </svg>
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="icon me-1 text-danger"
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      stroke-width="2"
                      stroke="currentColor"
                      fill="none"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      v-else
                    >
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <line x1="18" y1="6" x2="6" y2="18"></line>
                      <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>

                    {{ val.meta_value }}
                  </li>
                </ul>
                <div class="text-center mt-4">
                  <a href="#" class="btn w-100">Choose plan</a>
                </div>
                <div class="mt-2">
                  <span class="dropdown">
                    <button
                      class="btn dropdown-toggle align-text-top"
                      data-bs-boundary="viewport"
                      data-bs-toggle="dropdown"
                    >
                      Actions
                    </button>
                    <div class="dropdown-menu">
                      <button
                        class="dropdown-item"
                        @click="redirectToEditForm(item.id)"
                      >
                        Edit
                      </button>
                      <button class="dropdown-item" @click="deleteService(item.id)">Delete</button>
                    </div>
                  </span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="card card-md">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col">
                    <h2 class="h3">
                      Enterprise-ready. Reach out for a custom quote.
                    </h2>
                    <p class="m-0 text-muted">
                      Tabler is designed to work great for large enterprises.
                      Take a look at our feature comparison.
                    </p>
                  </div>
                  <div class="col-auto">
                    <a href="#" class="btn"> Book a demo </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { mapState, mapActions } from 'vuex'
import Paginate from '@/components/Paginate.vue'
import StatusLabel from '@/components/StatusLabel.vue'

export default {
  name: 'AdminAreaPost',
  layout: 'admin.root',
  components: { Paginate, StatusLabel },
  data() {
    return {
      errors: {}
    }
  },

  computed: { ...mapState('service', ['items']) },

  async fetch({ store }){
    await store.dispatch('service/getServiceList') || []
  },


  // mounted () {
  //   // eslint-disable-next-line no-console
  //   console.log(this.items);
  // },

  methods: {

    redirectToEditForm(id) {
      this.$router.push({ path: '/admin/service/edit', query: { id: id } })
    },

    async deleteService(id){
      try {
        if(confirm("Bạn chắc chắn muốn xóa dịch vụ này ?")){
          await this.$store.dispatch('service/removeService', id)
          await this.$store.dispatch('service/getServiceList')
          this.$toast.success('Xóa thành công !')
        }
        return
      } catch (error) {
        this.$toast.error('Có lỗi xảy ra !')
        this.errors = this.$mixError(error)
      }

    },

    paginate: async function (paged) {
      this.$store.dispatch('service/getServiceList', paged)
    },
  },
}
</script>
