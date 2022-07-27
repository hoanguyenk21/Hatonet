<template>
  <section>
    <div class="row">
      <div class="col-12">
        <nuxt-link to="/admin/post">Tất cả bài viết</nuxt-link>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-md-8 col-xl-8">
        <div class="mb-3">
          <label class="form-label">Tiêu đề</label>
          <input
            type="text"
            class="form-control"
            placeholder="Phiếu yêu cầu chỉnh sửa ...."
          />
        </div>
         <div class="mb-3">
          <div class="form-label">Phòng hỗ trợ</div>
          <select class="form-select">
            <option value="1">Phòng kinh doanh</option>
            <option value="2">Phòng kỹ thuật</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">
            <span>Nội dung</span>
            <span class="form-label-description">56/100</span>
          </label>
          <client-only>
            <VueEditor v-model="post.content" />
          </client-only>
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
  name: "AdminAreaPost",
  layout: "admin.root",
  data: () => ({
    post: {},
  }),
  async created() {
    try {
      let resp = await this.$axios.get("/api/accounts");
      this.account = resp.data;
    } catch (error) {
      console.log(error);
    }
  },
  methods: {
    nextPage: async function (paged) {
      let resp = await this.$axios.get(`/api/accounts?page=${paged}`);
      this.account = resp.data;
    },
  },
};
</script>

<style>
</style>
