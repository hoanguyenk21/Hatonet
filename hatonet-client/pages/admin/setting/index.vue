<template>
  <section class="row">
    <div class="col-6 col-md-6 col-xl-6">
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
      <div class="mb-3 w-75">
        <button class="btn btn-primary">Thêm danh mục</button>
      </div>
    </div>
    <div class="col-6 col-md-6 col-xl-6">
      <div class="card">
        <div class="table-responsive">
          <table class="table table-vcenter card-table table-striped">
            <thead>
              <tr>
                <th>Name</th>
                <th>Role</th>
                <th class="w-1"></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Maryjo Lebarree</td>
                <td class="text-muted">User</td>
                <td>
                  <a href="#">Edit</a>
                </td>
              </tr>
            </tbody>
          </table>
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
  computed: { ...mapState(["option"]) },
  components: { Paginate, StatusLabel },
  async fetch({ store }) {
    await store.dispatch("setting/getOptionList");
  },
  methods: {
    paginate: async function (paged) {
      this.$store.dispatch("setting/getOptionList", paged);
    },

  },
};
</script>

<style>
</style>
