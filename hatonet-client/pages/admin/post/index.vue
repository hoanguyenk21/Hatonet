<template>
  <section>
    <div class="row mb-3">
      <div class="col-12">
        <btn-create label="Tạo bài viết" url="/admin/post/add" />
        <nuxt-link class="btn w-25" to="/admin/post/category">
          <div class="d-flex align-items-center">
            <i class="ti ti-folder"></i><span> Danh mục</span>
          </div>
        </nuxt-link>
        <nuxt-link class="btn w-25" to="/admin/post/tag">
          <div class="d-flex align-items-center">
            <i class="ti ti-tags"></i>
            <span>Thẻ</span>
          </div>
        </nuxt-link>
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
                  <select class="form-control selectshow" v-model="searchPostNumber">
                    <option v-for="number in options.searchNumber" :key="number.id" :value="number.id" :selected="number.id">
                      {{ number.label }}
                    </option>
                  </select>
                </div>
                mục
              </div>
               <span class="ti ti-x icons" @click="click('searchPostNumber')"></span>
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
                  <input type="text" class="form-control form-control-sm search-input" placeholder="Nhập tiêu đề để tìm kiếm" aria-label="Search invoice"
                    v-model="searchPost"  />
                </div>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable">
              <thead>
                <tr>
                  <th class="w-1">
                    <input  @change="checkall($event)" :checked="isCheck"  class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices" />
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
              <tbody v-for="post in items.data" :key="post.id">
                <tr v-if="post.type == 'post'">
                  <td>
                    <input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"
                      @change="checkProductSelected($event, post.id)" :checked="isCheck" />
                  </td>
                  <td>
                    <a href="invoice.html" class="text-reset" tabindex="-1" v-text="post.title"></a>
                  </td>
                  <td>
                    <span class="flag flag-country-gb" v-text="post.slug"></span>
                  </td>
                  <td>
                    <p name="description" id="" cols="30" rows="10" v-text="post.description"></p>
                  </td>
                  <td>
                    <p v-text="post.content"></p>
                  </td>
                  <td class="tdImage">
                    <SectionImage  :src="baseUrl + post.image"  />
                  </td>
                  <td class="tdImage">
                    <SectionImage   class="img"  :src="baseUrl + post.thumbnail"  />
                  </td>
                  <td>
                    <p v-if="post.term" v-text="post.term.title"></p>
                  </td>
                  <td>
                    <p v-if="post.taxonomy" v-text="post.taxonomy.title"></p>
                  </td>
                  <td>
                    <p v-if="post.user" v-text="post.user.name"></p>
                  </td>
                  <td>
                    <p v-text="post.status"></p>
                  </td>
                  <td class="text-end">
                    <span class="dropdown">
                      <button class="btn align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown"
                        @click="RemoveAll(post.id)">
                        xóa
                      </button>
                    </span>
                  </td>
                  <td>
                    <span>
                      <button class="btn align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown"
                        @click="redirectToEditFormPost(post.id)">
                        Sửa
                      </button>
                    </span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="card-footer d-flex align-items-center">
            <paginate :total="items.total" @paginate="paginate" />
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>

  import {mapState,mapActions} from 'vuex'
  import Paginate from '@/components/Paginate.vue'
  import BtnCreate from '@/components/admin/BtnCreate.vue'
  import { SEARCHNUMBER } from '../../../constants/common'
  import {baseUrl} from '@/env/env.development.js'
  import SectionImage from '@/components/client/SectionImage.vue'
  import axios from 'axios'
import post from '../../../store/admin/post'
  export default {
    name: 'AdminAreaPost',
    layout: 'admin.root',
    components: {
      Paginate,
      BtnCreate,SectionImage
    },
    data: function () {
      return {
        options: {
            searchNumber: SEARCHNUMBER, 
          },
        searchPost: null,
        searchPostNumber: '',
        baseUrl: baseUrl,
        productSelected: false,
        listProductSelected: [],
        isCheck: false
      }
    },
     computed: {
      ...mapState('post', ['items']),
    },
    async fetch({store}) {
      try {
        await store.dispatch('post/getPostList', {keyword: null , number: null})
      } catch (error) {
        // this.$mixError(error)
      }
    },
    
  watch: {
    searchPost: function () {
      this.searchData()
    },
    searchPostNumber: function () {
      this.numberData()
    },
    '$route.query'() {
      this.$created()
    },
  },
    methods: {
      async searchData() {
       await this.$store.dispatch('post/getPostList', {keyword: this.searchPost});
      },
      async numberData() {
        await this.$store.dispatch('post/getPostList', {number: this.searchPostNumber})
      },
      async Remove($id) {
        if (confirm('Bạn có chắc chắn muốn xóa không ?')) {
          await this.$store.dispatch('post/removePost', $id)
        }
      },
      redirectToEditFormPost(id) {
        this.$router.push({path: 'post/edit',query: {id: id}})},
      async paginate(page) {
        if (this.searchPost) {
          await this.$store.dispatch('post/getPostList', {keyword: this.searchPost , page})
        } else {
          await this.$store.dispatch('post/getPostList', {keyword: null , number: null , page});
        }
      },
      async checkall(event){
        let checked = event.target.checked
        this.isCheck = !this.isCheck;
        if(checked){
          this.items.data.forEach(item => {
            this.listProductSelected.push(item.id)
        });      
        }else{
           this.items.data.forEach(item => {
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
        if (checked){
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
          if (typeof listProductSelected == 'number') {
            listProductSelected = [listProductSelected]         
          }
          this.isCheck = false
          this.productSelected = false
          await this.$store.dispatch('post/removePost', listProductSelected)
          await this.$store.dispatch('post/getPostList', {keyword: null , number: null})
        
        }
      },
      click(model) {
      switch (model) {
        case 'searchPostNumber':
          this.searchPostNumber = null;
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
  .tdImage {
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
