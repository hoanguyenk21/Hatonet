<template>
  <section>
    <div class="row mb-3">
      <div class="col-12">
        <btn-create label="Trang" url="/admin/page/add" />
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body border-bottom py-3">
            <div class="d-flex">
              <div class="text-muted">
                Hiện thị
                <div class="mx-2 d-inline-block">
                  <select class="form-control selectshow" v-model="searchPageNumber" >
                    <option v-for="number in options.searchNumber" :key="number.id" :value="number.id"
                      :selected="number.id">
                      {{ number.label }}
                    </option>
                  </select>
                </div>
                mục
              </div>
               <span class="ti ti-x icons" @click="click('searchPageNumber')"></span>
               <div v-if="productSelected" class="ms-auto text-muted">
                <span class="dropdown">
                  <button class="btn align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown"
                    @click="RemoveAll(listProductSelected)">
                    xóa
                  </button>
                </span>
              </div>
              <div class="ms-auto text-muted">
                Tìm kiếm:
                <div class="ms-2 d-inline-block">
                  <input
                    type="text"
                    class="form-control form-control-sm search-input"
                    aria-label="Search invoice"
                    placeholder="Nhập tiêu đề để tìm kiếm"
                    v-model="searchPage"
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
                     @change="checkall($event)"
                     :checked="isCheck" 
                      class="form-check-input m-0 align-middle"
                      type="checkbox"
                      aria-label="Select all invoices"
                    />
                  </th>
                  <th>Tiêu đề</th>
                  <th>Đường dẫn</th>
                  <th>Mô tả</th>
                  <th>Nội dung</th>
                  <th>Ảnh</th>
                  <th>Ảnh nhỏ</th>
                  <th>Thẻ</th>
                  <th>Danh mục</th>
                  <th>Người dùng</th>
                  <th>Trạng thái</th>
                  <th>Hành động</th>
                </tr>
              </thead>
              <tbody v-for="page in pages.data" :key="page.id">
                <tr v-if="page.type == 'page'">
                  <td>
                    <input
                      class="form-check-input m-0 align-middle"
                      type="checkbox"
                      aria-label="Select invoice"
                      @change="checkProductSelected($event, page.id)"
                      :checked="isCheck"
                    />
                  </td>
                  <td>
                    <a
                      href="invoice.html"
                      class="text-reset"
                      tabindex="-1"
                      v-text="page.title"
                    ></a>
                  </td>
                  <td>
                    <span
                      class="flag flag-country-gb"
                      v-text="page.slug"
                    ></span>
                  </td>
                  <td>
                    <p
                      name="description"
                      id=""
                      cols="30"
                      rows="10"
                      v-text="page.description"
                    ></p>
                  </td>
                  <td>
                    <p v-text="page.content"></p>
                  </td>
                  <td class="tdImage">
                    <SectionImage   class="img" :src="baseUrl + page.image" alt="" width="100%" height="100%"  />
                  </td>
                  <td class="tdImage">
                    <SectionImage   class="img" :src="baseUrl + page.thumbnail"  />
                  </td>
                  <td>
                    <p v-if="page.term" v-text="page.term.title"></p>
                  </td>
                  <td>
                    <p v-if="page.taxonomy" v-text="page.taxonomy.title"></p>
                  </td>
                  <td>
                    <p  v-if="page.user" v-text="page.user.name"></p>
                  </td>
                  <td>
                    <p v-text="page.status"></p>
                  </td>
                  <td class="text-end">
                    <span class="dropdown">
                      <button
                        class="btn align-text-top"
                        data-bs-boundary="viewport"
                        data-bs-toggle="dropdown"
                        @click="RemoveAll(page.id)"
                      >
                        xóa
                      </button>
                    </span>
                  </td>
                  <td class="text-end">
                    <span class="dropdown">
                      <button
                        class="btn align-text-top"
                        data-bs-boundary="viewport"
                        data-bs-toggle="dropdown"
                        @click="redirectToEditFormpage(page.id)">
                        Sửa
                      </button>
                    </span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="card-footer d-flex align-items-center">
            <paginate :total="pages.total" @paginate="paginate" />
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { mapState, mapActions } from 'vuex'
import Paginate from '@/components/Paginate.vue'
import StatusLabel from '@/components/StatusLabel.vue'
import BtnCreate from '@/components/admin/BtnCreate.vue'
import {baseUrl} from '@/env/env.development.js'
import { SEARCHNUMBER } from '../../../constants/common'
import SectionImage from '../../../components/client/SectionImage.vue'
export default {
  name: 'AdminAreaPost',
  layout: 'admin.root',
  components: { Paginate, StatusLabel, BtnCreate,SectionImage },
  computed: { ...mapState('page',['pages']) },
  data: function () {
    return {
      options: {
        searchNumber: SEARCHNUMBER, 
      },
      searchPage: null,
      searchPageNumber: '',
      user_id: '',
      baseUrl: baseUrl,
      productSelected: false,
      listProductSelected: [],
      isCheck: false,
    }
  },
  async fetch({store}) {
    try {
        await store.dispatch('page/getPageList', {keyword: null , number: null})
    } catch (error) {
      // this.$mixError(error)
    }
  },
    watch: {
    searchPage: function () {
      this.searchData()
    },
    searchPageNumber: function () {
      this.numberData()
    },
    '$route.query'() {
      this.$created()
    },
  },
   methods: {
      async searchData() {
       await this.$store.dispatch('page/getPageList', {keyword: this.searchPage});
      },
      async numberData() {
        await this.$store.dispatch('page/getPageList', {number: this.searchPageNumber})
      },
      async Remove($id) {
        if (confirm('Bạn có chắc chắn muốn xóa không ?')) {
          await this.$store.dispatch('page/removePage', $id)
        }
      },
      redirectToEditFormpage(id) {
        this.$router.push({path: 'page/edit',query: {id: id}})},
      async paginate(page) {
        if (this.searchPage) {
          await this.$store.dispatch('page/getPageList', {keyword: this.searchPage , page})
        } else {

          await this.$store.dispatch('page/getPageList', {keyword: null , number: null , page});
        }
      },
         async checkall(event){
        let checked = event.target.checked
        this.isCheck = !this.isCheck;
        this.productSelected = !this.productSelected
        if(checked){
          this.pages.data.forEach(item => {
            this.listProductSelected.push(item.id)
        });      
        }else{
           this.pages.data.forEach(item => {
            this.listProductSelected.push(item.id)
                   const index = this.listProductSelected.indexOf(item.id);
                  if (index > -1) {
                    this.listProductSelected.splice(index, item.id);
                  }
            });  
        }
        if (this.listProductSelected.length) {
          this.productSelected = true;
        } else {
          this.productSelected = false;
        }
      },
      async checkProductSelected(event, productID) {
        let checked = event.target.checked  
          // this.productSelected = !this.productSelected
          if (checked) {
            this.listProductSelected.push(productID)      
          }else{
          const index = this.listProductSelected.indexOf(productID);
          if (index > -1) {
            this.listProductSelected.splice(index, 1);
          }
        }
        if(this.listProductSelected.length){
          this.productSelected = true;
        }else{
          this.productSelected = false;
        }
      },
      async RemoveAll(listProductSelected) {
        if (confirm('Bạn có chắc chắn muốn xóa không ?')) {
          this.productSelected = false
          if (typeof listProductSelected == 'number') {
            listProductSelected = [listProductSelected]
          }
          this.isCheck = false
          this.productSelected = false
          await this.$store.dispatch('page/removePage', listProductSelected)
          await this.$store.dispatch('page/getPageList', {keyword: null , number: null})
        }
      },
           click(model) {
      switch (model) {
        case 'searchPageNumber':
          this.searchPageNumber = null;
          break;
        default:
          break;
      }
    }
    },
}
</script>
<style scoped lang="scss">
.icons {
  position: absolute;
  margin-left: 100px;
  margin-top: 10px;
}
.selectshow {
    height: 32px;
    width: 60px;
}
.search-input{
  height: 32px;
}
.tdImage{
  width: 81.88px;
  height: 59.86px;
}
.tdImage img{
  height: 100%; 
}
.admin .text-nowrap {
    white-space: normal !important;
}
</style>
