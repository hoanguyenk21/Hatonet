<template>
  <div>
    <div v-if="status === 'active'" class="d-flex align-items-center">
      <span class="badge bg-success me-1"></span>
      <small>Sử dụng</small>
    </div>
    <div v-else-if="status === 'wait'" class="d-flex align-items-center">
      <span class="badge bg-warning me-1"></span>
      <small>Hết hạn</small>
    </div>
    <div v-else-if="status === 'suspended'" class="d-flex align-items-center">
      <span class="badge bg-danger me-1"></span>
      <small>Lệnh cấm</small>
    </div>
    <div v-else-if="status === 'pending'" class="d-flex align-items-center">
      <span class="badge bg-warning me-1"></span>
      <small>Chưa kích hoạt</small>
    </div>
    <div v-else class="d-flex align-items-center">
      <span class="badge bg-secondary me-1"></span>
      <small>Ngừng sử dụng</small>
    </div>
  </div>
</template>

<script>
export default {
  name: "StatusLabel",
  props: {
    status: {
      type: String,
      require: true,
    },
  },
};
</script>

<style>
</style>
