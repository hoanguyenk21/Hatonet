<template>
  <section class="row">
    <div class="col-12 col-md-12 col-xl-12">
      <div class="mb-3 w-75">
        <button class="btn btn-md btn-warning">Lưu cài đặt</button>
      </div>
      <div class="mb-3 w-75">
        <label class="form-label">Text</label>
        <input
          type="text"
          class="form-control"
          name="example-text-input"
          placeholder="Input placeholder"
        />
      </div>
      <div class="mb-3 w-75">
        <label class="form-label">Password</label>
        <input
          type="text"
          class="form-control"
          name="example-password-input"
          placeholder="Input placeholder"
        />
      </div>

      <div class="mb-3 w-75">
        <label class="form-label"
          >Textarea <span class="form-label-description">56/100</span></label
        >
        <textarea
          class="form-control"
          name="example-textarea-input"
          rows="6"
          placeholder="Content.."
        >
Oh! Come and see the violence inherent in the system! Help, help, I'm being repressed! We shall say 'Ni' again to you, if you do not appease us. I'm not a witch. I'm not a witch. Camelot!</textarea
        >
      </div>
      <div class="mb-3 w-75">
        <div class="form-label">Select</div>
        <select class="form-select">
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "AdminAreaPost",
  layout: "admin.root",
  data: () => ({
    account: {},
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
