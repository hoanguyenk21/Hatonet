<template>
  <section>
    <div class="row">
      <div class="col-12 col-md-8 col-xl-8">
        <div class="card mb-3">
          <div class="card-body">
            <div class="mb-3">
              <label class="form-label">Tên gói</label>
              <input
                type="text"
                class="form-control"
                placeholder="Phiếu yêu cầu chỉnh sửa ...."
              />
            </div>
            <div>
              <label class="form-check">
                <input class="form-check-input" type="checkbox" checked="" />
                <span class="form-check-label">Gói khuyên dùng</span>
              </label>
            </div>
          </div>
        </div>
        <div class="card mb-3">
          <div class="card-body">
            <div
              class="
                row
                align-items-center
                mb-3
                bg-light
                text-dark
                rounded-2
                py-2
              "
            >
              <div class="col-1">
                <button class="btn">
                  <i class="ti fs-2 ti-circle-plus"></i>
                </button>
              </div>
              <div class="col-2 px-3">
                <label class="form-check mb-0">
                  <input class="form-check-input" type="checkbox" checked="" />
                  <span class="form-check-label">Hỗ trợ</span>
                </label>
              </div>
              <div class="col-9">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Nội dung gói ..."
                />
              </div>
            </div>
            <div class="row align-items-center mb-1">
              <div class="col-1">
                <button class="btn">
                  <i class="ti ti-trash"></i>
                </button>
              </div>
              <div class="col-2 px-3">
                <label class="form-check mb-0">
                  <input class="form-check-input" type="checkbox" checked="" />
                  <span class="form-check-label text-dark">Hỗ trợ</span>
                </label>
              </div>
              <div class="col-9">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Nội dung gói ..."
                />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-4 col-xl-4">
        <div class="card mb-3">
          <div class="card-body">
            <button class="btn btn-primary">Tạo gói</button>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="mb-3">
              <label class="form-label">Giá dịch vụ</label>
              <input
                class="form-control"
                type="number"
                min="0.00"
                max="1000000000.00"
                step="0.001"
              />
            </div>
            <div class="mb-3">
              <label class="form-label">Giá khuyến mãi</label>
              <input
                class="form-control"
                type="number"
                min="0.00"
                max="1000000000.00"
                step="0.001"
              />
            </div>
            <div class="mb-3">
              <label class="form-label">Thời gian sử dụng</label>
              <select class="form-control">
                <option v-for="m in mounth" :key="m" :value="m">
                  Tháng {{ m }}
                </option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "AdminAreaPost",
  layout: "admin.root",
  data: () => ({
    item: {},
    mounth: 36,
  }),
  async created() {
    try {
      // let resp = await this.$axios.get("/api/accounts");
      // this.account = resp.data;
    } catch (error) {
      console.log(error);
    }
  },
  methods: {
    nextPage: async function (paged) {
      // let resp = await this.$axios.get(`/api/accounts?page=${paged}`);
      // this.account = resp.data;
    },
  },
};
</script>

<style>
</style>
