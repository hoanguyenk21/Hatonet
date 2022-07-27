<template>
  <section>
    <div class="row">
      <div class="col-12">
        <nuxt-link to="/admin/notify">Tất cả thông báo</nuxt-link>
      </div>
    </div>
    <div class="row">
      <div class="col-6 col-md-6 col-xl-6">
        <div class="mb-3">
          <label class="form-label">Tiêu đề</label>
          <input
            type="text"
            class="form-control"
            placeholder="Tiêu đề thông báo"
          />
        </div>
        <div class="mb-3">
          <div class="form-label">Loại thông báo</div>
          <select class="form-select">
            <option value="1">Tất cả công ty</option>
            <option value="2">Công ty đích danh</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">
            <span>Nội dung</span>
            <span class="form-label-description">56/100</span>
          </label>
          <textarea class="form-control" rows="3" placeholder="content.." />
        </div>
        <div class="mb-3">
          <button class="btn btn-primary">Tạo phiếu</button>
        </div>
      </div>
      <div class="col-12 col-md-4 col-xl-4">
        <div class="card">
          <span></span>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'AdminAreaPost',
  layout: 'admin.root',
  data: () => ({
    item: {},
  }),
  fetch({ store, $mixError }) {
    try {
      //
    } catch (error) {}
  },
  methods: {
    nextPage: async function (paged) {
      // let resp = await this.$axios.get(`/api/accounts/?page=${paged}`);
      // this.account = resp.data;
    },
  },
}
</script>

<style>
</style>
