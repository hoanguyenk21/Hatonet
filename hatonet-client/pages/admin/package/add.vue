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
                v-model="item.title"
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
                <button class="btn" @click="pushAttribute">
                  <i class="ti fs-2 ti-circle-plus"></i>
                </button>
              </div>

              <div class="col-2 px-3">
                <label class="form-check mb-0">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    v-model="attribute.support"
                  />
                  <span class="form-check-label">Hỗ trợ</span>
                </label>
              </div>
              <div class="col-9">
                <input
                  type="text"
                  class="form-control"
                  v-model="attribute.name"
                  placeholder="Nội dung hỗ trợ ."
                />
              </div>
            </div>

            <section v-for="(attr, i) in item.meta" :key="i">
              <div class="row align-items-center mb-1">
                <div class="col-1">
                  <button class="btn" @click="remoteAttribute(i)">
                    <i class="ti ti-trash"></i>
                  </button>
                </div>
                <div class="col-2 px-3">
                  <label class="form-check mb-0">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      v-model="item.meta[i].support"
                    />
                    <span class="form-check-label text-dark">Hỗ trợ</span>
                  </label>
                </div>
                <div class="col-9">
                  <input
                    type="text"
                    class="form-control"
                    v-model="item.meta[i].name"
                    placeholder="Nội dung gói ..."
                  />
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-4 col-xl-4">
        <div class="card mb-3">
          <div class="card-body">
            <button class="btn btn-primary" @click="add">Tạo gói</button>
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
                v-model="item.price_base"
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
                v-model="item.price_sale"
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
import { mapActions } from 'vuex'

export default {
  name: 'AdminAreaPost',
  layout: 'admin.root',
  data: () => ({
    item: {
      meta: [],
    },
    attribute: {
      support: false,
      name: '',
    },
    mounth: 36,
  }),
  async created() {
    // try {
    //   let resp = await this.$axios.get("/api/accounts");
    //   this.account = resp.data;
    // } catch (error) {
    //   console.log(error);
    // }
  },
  methods: {
    ...mapActions('service', ['createService']),

    add() {
      this.createService({
        ...this.item,
        user_id: 1,
      })
      this.item = { meta: [] }
    },

    pushAttribute: function () {
      if (this.attribute.name === '') {
        alert('Nội dung trống không thể tạo thuộc tính')
        return
      }
      // push meta
      this.item.meta.push(this.attribute)
      // clear
      this.attribute = {
        support: false,
        name: '',
      }
    },

    remoteAttribute: function (index) {
      this.item.meta.splice(index, 1)
    },
  },
}
</script>

<style></style>
