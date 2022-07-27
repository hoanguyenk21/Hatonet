<template>
  <section>
    <div class="card mb-2">
      <div class="card-control">
        <ul class="step">
          <li class="active" title="1">
            <span>Thông tin</span>
          </li>
          <li title="2">
            <span>Đăng tin</span>
          </li>
        </ul>
        <div class="btn-request">
          <button class="btn-post" @click="addProduct">Tiếp Theo</button>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
        <section title="Thông tin" :selected="true">
          <!-- /header -->
          <div class="row">
            <div class="col-lg-8">
              <div class="mb-3">
                <div class="row">
                  <div class="mb-3 mt-3">
                    <label class="form-label">Tiêu đề</label>
                    <input type="text" class="form-control" v-model="detail.title" />
                  </div>
                  <div>
                    <label class="form-label">Slug</label>
                    <input type="text" class="form-control" v-model="detail.slug" disabled>
                  </div>
                  <!-- /form-group -->
                </div>
              </div>
              <div class="mb-3">
                <div class="row">
                  <div class="col-12 col-lg-4 mb-3">
                    <label class="form-label">Tỉnh / thành phố</label>
                    <select class="form-select" v-model="detail.meta._address">
                      <template v-for="location in options.location">
                        <option :key="location" :value="location.id">
                          {{ location.name }}
                        </option>
                      </template>
                    </select>
                  </div>
                  <!-- /form-group -->
                  <div class="col-12 col-lg-4 mb-3">
                    <div class="form-label">Kinh nghiệm</div>
                    <select class="form-select" v-model="detail.meta._number_Level">
                      <option value="" disabled selected>
                        Số năm làm việc
                      </option>
                      <template v-for="exp in options.exp">
                        <option :key="exp" :value="exp.id">
                          {{ exp.name }}
                        </option>
                      </template>
                    </select>
                  </div>
                  <div class="col-12 col-lg-4 mb-3">
                    <div class="form-label">Giá bán / Người / Tháng</div>
                    <input type="" min="1" class="form-control" v-model="detail.price_sale"
                      oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <div class="row">
                  <div class="col-12 col-lg-4 mb-3">
                    <label class="form-label">Hạn ứng tuyển</label>
                    <flat-pickr v-model="detail.meta._dateline" :config="{ dateFormat: 'd/m/Y', minDate: 'today' }"
                      placeholder="dd/mm/yyyy" />
                  </div>
                  <!-- /form-group -->
                  <div class="col-12 col-lg-4 mb-3">
                    <label class="form-label">Ngày kết thúc</label>
                    <flat-pickr v-model="detail.meta._timeline" :config="{ dateFormat: 'd/m/Y', minDate: 'today' }"
                      placeholder="dd/mm/yyyy" />
                  </div>
                  <div class="col-12 col-lg-4 mb-3">
                    <label class="form-label">Số lượng</label>
                    <input type="number" min="1" class="form-control" v-model.number="detail.meta.memberNumber"
                      disabled />
                  </div>
                </div>
              </div>
              <div class="form-group mb-3">
                <label class="form-label">
                  <span>Nội dung</span>
                </label>
                <textarea class="form-control" rows="5" v-model="detail.content" />
              </div>
              <div class="form-group">
                <label class="form-label">
                  <span>Mô tả</span>
                </label>
                <textarea class="form-control" rows="5" v-model="detail.description" />
              </div>
            </div>
            <!-- /col-lg-8 -->
            <div class="col-lg-4">
              <aside class="aside">
                <div class="form-group mb-3">
                  <div class="form-label">Cấp bậc</div>
                  <select class="form-select" v-model="detail.meta._rank">
                    <template v-for="rank in options.rank">
                      <option :key="rank" :value="rank.id">
                        {{ rank.name }}
                      </option>
                    </template>
                  </select>
                </div>
                <div class="form-group mb-3">
                  <div class="form-label">Trình độ học vấn</div>
                  <select class="form-select" v-model="detail.meta._education_Level">
                    <template v-for="education in options.education">
                      <option :key="education" :value="education.id">
                        {{ education.name }}
                      </option>
                    </template>
                  </select>
                </div>
                <div class="form-group mb-3">
                  <label class="form-label">Loại hình làm việc</label>
                  <select class="form-select" v-model="detail.meta._type_work">
                    <template v-for="work in options.work">
                      <option :key="work" :value="work.id">
                        {{ work.name }}
                      </option>
                    </template>
                  </select>
                </div>
                <div class="form-group mb-3">
                  <label class="form-label">Kỹ năng yêu cầu</label>
                  <select class="form-select" v-model="detail.meta._skill">
                    <template v-for="skill in options.skill">
                      <option :key="skill" :value="skill.id">
                        {{ skill.name }}
                      </option>
                    </template>
                  </select>
                </div>
                <div class="form-group" v-if="getuser.roles == 'admin'">
                  <label class="form-label">Trạng Thái</label>
                  <select class="form-select" v-model="detail.status">
                    <option v-for="status in statuses" :key="status.id" :value="status.value">
                      {{ status.name }}
                    </option>
                  </select>
                </div>
              </aside>
            </div>
          </div>
        </section>
      </div>
    </div>
  </section>
</template>

<script>
import { mapState } from 'vuex'
import { LOCATION } from '@/constants/common'
import { EDUCATION, EXP, RANK, SKILL, STATUS, WORK } from '../../../constants/common'
export default {
  name: 'AdminAreaProductAdd',
  layout: 'admin.root',
  data: () => ({
    auth: {},
    options: {
      location: LOCATION,
      exp: EXP,
      skill: SKILL,
      education: EDUCATION,
      rank: RANK,
      work: WORK,
    },
    statuses: [
      {
        id: 121,
        name: 'Pending',
        value: 'pending',
      },
      {
        id: 122,
        name: 'Wait',
        value: 'wait',
      },
    ],
  }),

  computed: {
    ...mapState('product', ['detail']),
    getuser({ $cookies }) {
      return $cookies.get('_user');
    },
  },

  async fetch({ store, $cookies, route }) {
    this.auth = $cookies.get('_user');
    let { id } = route.query
    if (id) {
      const resp = (await store.dispatch('product/getProductId', id)).data;
      this.product = resp

    }
  },

  methods: {
    async addProduct() {
      try {
        let data = (await this.$store.dispatch('product/updateProduct', this.detail)).data
        this.$router.push({ path: `/admin/product/checkadd`, query: { id: data.id } });
      } catch (error) {
        this.errors = this.$mixError(error);
      }
    },
  },
}
</script>

<style scoped lang="scss">
.step {
  display: flex;
  list-style: none;
  margin: 0;
  padding: 0;
  align-items: center;

  span {
    margin: 5px 25px;
    display: inline-block;
  }

  li {
    position: relative;
    width: 180px;

    &:before {
      content: attr(title);
      background: #fff;
      border: 1px solid #ff6116;
      border-radius: 5px;
      color: #ff6116;
      display: block;
      margin: 0 35px;
      text-align: center;
      width: 35px;
      height: 35px;
      line-height: 35px;
      font-size: 0.8rem;
      letter-spacing: 1px;
      font-weight: 500;
      position: relative;
      z-index: 1;
    }

    &:after {
      content: '';
      height: 3px;
      left: 35px;
      position: absolute;
      top: 15px;
      width: 100%;
      z-index: 0;
      border-bottom: 1px dashed #ddd;
    }
  }

  li:last-child {
    &:after {
      border-bottom: none;
    }
  }

  .active {
    &:before {
      background: #ff6116;
      color: #fff;
    }
  }
}

.aside {
  background-color: #f7f6f6;
  padding: 1em;
  border-radius: 10px;
}

.card-control {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1em;
}

.flatpickr-input {
  display: block;
  width: 100%;
  padding: 0.4375rem 0.75rem;
  font-size: 0.875rem;
  font-weight: 400;
  line-height: 1.4285714286;
  color: inherit;
  background-color: #ffffff;
  background-clip: padding-box;
  border: 1px solid #d9dbde;
  appearance: none;
  border-radius: 4px;
}

.btn-post {
  padding: 0.4em 3em;
  border: 2px solid #ff6116;
  background: #ff6116;
  color: #fff;
  border-radius: 20px;
}

.btn-request {
  display: inline-flex;
  margin-top: 0.5em;
  font-weight: 100;
  font-size: 0.8rem;
  flex-direction: column;
  align-items: center;

  label {
    margin-top: 0.5em;
    display: flex;
    align-items: center;
    gap: 5px;
  }
}

.admin a:hover {
  color: #ffffff;
  text-decoration: none;
}
</style>
