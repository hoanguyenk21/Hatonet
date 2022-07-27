<template>
  <section>
    <div class="row mb-3">
      <div class="col-12">
        <nuxt-link
          class="btn btn-green text-dark py-1"
          to="/admin/ticket/add"
        >
          <div class="d-flex align-items-center">
            <i class="fs-3 ti ti-file-plus"></i>
            <span>Tạo phiếu</span>
          </div>
        </nuxt-link>
        <nuxt-link class="btn py-1" to="/admin/post/category">
          <div class="d-flex align-items-center">
            <i class="fs-3 ti ti-folder"></i>
            <span class="p-1 pb-0"> Danh mục</span>
          </div>
        </nuxt-link>
        <nuxt-link class="btn py-1" to="/admin/post/tag">
          <div class="d-flex align-items-center">
            <i class="fs-3 ti ti-tags"></i>
            <span class="p-1 pb-0">Thẻ</span>
          </div>
        </nuxt-link>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body border-bottom py-3">
            <div class="d-flex">
              <div class="text-muted">
                Show
                <div class="mx-2 d-inline-block">
                  <input
                    type="text"
                    class="form-control form-control-sm"
                    value="8"
                    size="3"
                    aria-label="Invoices count"
                  />
                </div>
                entries
              </div>
              <div class="ms-auto text-muted">
                Search:
                <div class="ms-2 d-inline-block">
                  <input
                    type="text"
                    class="form-control form-control-sm"
                    aria-label="Search invoice"
                  />
                </div>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable">
              <thead>
                <tr>
                  <th class="w-1">
                    <input
                      class="form-check-input m-0 align-middle"
                      type="checkbox"
                      aria-label="Select all invoices"
                    />
                  </th>
                  <th class="w-1">
                    No.
                    <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="icon icon-sm text-dark icon-thick"
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
                      <polyline points="6 15 12 9 18 15"></polyline>
                    </svg>
                  </th>
                  <th>Status</th>
                  <th>Client</th>
                  <th>VAT No.</th>
                  <th>Created</th>
                  <th>Price</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <input
                      class="form-check-input m-0 align-middle"
                      type="checkbox"
                      aria-label="Select invoice"
                    />
                  </td>
                  <td>
                    <i class="ti fs-1 ti-ticket text-gray-800"></i>
                  </td>
                  <td>
                    <span class="flag flag-country-gb"></span>
                    Adobe
                  </td>
                  <td>87956421</td>
                  <td>12 Apr 2017</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="badge bg-warning me-1"></span>
                      <span>customer</span>
                    </div>
                  </td>
                  <td>$1200</td>
                  <td class="text-end">
                    <button class="btn">
                      <i class="ti ti-arrow-big-right-lines"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="card-footer d-flex align-items-center">
            <p class="m-0 text-muted">
              Showing <span>1</span> to <span>8</span> of
              <span>16</span> entries
            </p>
            <ul class="pagination m-0 ms-auto">
              <li class="page-item disabled">
                <a
                  class="page-link"
                  href="#"
                  tabindex="-1"
                  aria-disabled="true"
                >
                  <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="icon"
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
                    <polyline points="15 6 9 12 15 18"></polyline>
                  </svg>
                  prev
                </a>
              </li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item active">
                <a class="page-link" href="#">2</a>
              </li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">4</a></li>
              <li class="page-item"><a class="page-link" href="#">5</a></li>
              <li class="page-item">
                <a class="page-link" href="#">
                  next
                  <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="icon"
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
                    <polyline points="9 6 15 12 9 18"></polyline>
                  </svg>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { mapState } from "vuex";
import Paginate from "@/components/Paginate.vue";
import StatusLabel from "@/components/StatusLabel.vue";
export default {
  name: "AdminAreaPost",
  layout: "admin.root",
  computed: { ...mapState(["ticket"]) },
  components: { Paginate, StatusLabel },
  async fetch({ store }) {
    await store.dispatch("ticket/getTicketList");
  },
  methods: {
    paginate: async function (paged) {
      this.$store.dispatch("ticket/getTicketList", paged);
    },
  },
};
</script>

<style>
</style>
