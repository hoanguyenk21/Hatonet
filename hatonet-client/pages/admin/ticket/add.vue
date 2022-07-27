<template>
  <section class="row">
    <div class="col-12 col-md-8 col-xl-8 card">
      <div class="card-body">
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
            <button class="btn">
              <i class="ti ti-camera-plus"></i>
              <span>Tệp đính kèm</span>
            </button>
          </label>
          <client-only>
            <VueEditor v-model="ticket.content" />
          </client-only>
        </div>
        <div class="mb-3">
          <button class="btn btn-primary">Tạo phiếu</button>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-4 col-xl-4">
      <div class="card">
        <span></span>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "AdminAreaPost",
  layout: "admin.root",
  data: () => ({
    ticket: {},
  }),
  methods: {},
};
</script>

<style>
</style>
