<template>
  <section>
    <div class="row">
      <div class="mb-3">
         <nuxt-link class="btn btn-dark btn-block" to="/admin/post">Quay lại</nuxt-link>
      </div>
      <div class="col-12 col-md-8 col-xl-8">
        <div class="card">
          <div class="card-body p-2">
            <div class="mb-3">
              <label class="form-label required">Tiêu đề</label>
              <input
                type="text"
                class="form-control"
                placeholder="Tiêu đề"
                v-model="show.title"
                :class="[{ 'is-invalid': errors.title }]"
              />
                <span class="text-danger alertSpan" v-if="errors && errors.title">
                  {{ errors.title[0] }}
                </span>
            </div>
            <div class="mb-3">
              <label class="form-label required">Đường dẫn</label>
              <input
                type="text"
                class="form-control"
                placeholder="Đường dẫn"
                v-model="show.slug"
                :class="[{ 'is-invalid': errors.slug }]"
              />
              <span class="text-danger alertSpan" v-if="errors && errors.slug">
                {{ errors.slug[0] }}
              </span>
            </div>
            <div class="mb-3">
              <label class="form-label">image</label>
              <input
                type="file"
                class="form-control"
                name="image"
                @change="uploadImage($event)"
              />
            </div>
            <div class="mb-3 editor">
              <label class="form-label required">
                <span>Mô tả</span>
              </label>
              <!-- <client-only>
                <VueEditor
                  v-model="show.description"
                  placeholder="Mô tả"
                   :editor-toolbar="customToolbar"     
                   :class="[{ 'is-invalid': errors.description }]"
                />
                  <span class="text-danger alertSpan" v-if="errors && errors.title">
                  {{ errors.description[0] }}
                </span>
              </client-only> -->
               <textarea  class="form-control" name="" id="" cols="95" rows="5"  v-model="show.description"     ></textarea>
            </div>
            <div class="mb-3 editor">
              <label class="form-label">
                <span>Nội dung</span>
              </label>
              <!-- <client-only>
                <VueEditor
                  v-model="show.content"
                  placeholder="Nội dung"
                   :editor-toolbar="customToolbar"     
                   :class="[{ 'is-invalid': errors.content }]"
                />
                   <span class="text-danger alertSpan" v-if="errors && errors.title">
                  {{ errors.content[0] }}
                </span>
              </client-only> -->
               <textarea  class="form-control" name="" id="" cols="95" rows="5"  v-model="show.content"     ></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-4 col-xl-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="mb-3">
              <button class="btn btn-dark btn-block" @click="editPost()">
                Sửa bài viết
              </button>
            </div>
               <div class="mb-3">
                 <div class="form-group">
                  <label class="form-label">Trạng thái</label>
                  <select class="form-select" v-model="show.status"  :class="[{ 'is-invalid': errors.status }]">
                    <option v-for="status in  options.status" :key="status.id" :value="status.value"
                      :selected="status.id">
                      {{ status.name }}
                    </option>
                  </select>
                </div>
               <span class="text-danger alertSpan" v-if="errors && errors.status">
                {{ errors.status[0] }}
              </span>
            </div>
            <div class="mb-3">
               <div class="form-group">
                  <label class="form-label">Term</label>
                  <select class="form-select" v-model="show.term_id" :class="[{ 'is-invalid': errors.term_id }]">
                    <option v-for="(term, index) in terms" v-bind:key="index" :value="term.id"
                      :selected="term.id">
                      {{ term.title }}
                    </option>
                  </select>
                </div>
                <span class="text-danger alertSpan" v-if="errors && errors.term_id">
                {{ errors.term_id[0] }}
              </span>
            </div>
            <div class="mb-3">
                <div class="form-group mb-3">
                  <label class="form-label">Danh mục</label>
                  <select class="form-select" v-model="show.taxonomy_id" :class="[{ 'is-invalid': errors.taxonomy_id }]">
                    <option v-for="(taxonomy, index) in categories" v-bind:key="index" :value="taxonomy.id"
                      :selected="taxonomy.id">
                      {{ taxonomy.title }}
                    </option>
                  </select>
                </div>
               <span class="text-danger alertSpan" v-if="errors && errors.taxonomy_id">
                {{ errors.taxonomy_id[0] }}
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>  
import { mapState} from 'vuex'
import { STATUSPOST } from '../../../constants/common'
export default {
  name: 'AdminAreaPost',
  layout: 'admin.root',
  data: () => ({
    customToolbar: [
      ['bold', 'italic', 'underline'],
      [{ list: 'ordered' }, { list: 'bullet' }],
      ['image'],
    ],
    errors: {},
    options: {
      status: STATUSPOST, 
    },
  }),
   computed: { 
    ...mapState('post' , ['show']),
    ...mapState('category' , ['categories']),
    ...mapState('term' , ['terms']) 
    },
  async fetch({ store, route }) {
    try {
      await store.dispatch('post/getPostId',  {id: route.query.id});
      await store.dispatch('category/getAll');
      await store.dispatch('term/getAll');
    } catch (error) {
      // this.$mixError(error)
    }
  },
  methods: {
    async editPost() {
      try {
        let formData = new FormData();
        formData.append('id' , this.show.id);
        formData.append('title' , this.show.title);
        formData.append('description' , this.show.description);
        formData.append('content', this.show.content);
        formData.append('image' , this.show.image);
        formData.append('thumnail' , this.show.image);
        formData.append('slug' , this.show.slug);
        formData.append('status' , this.show.status);   
        formData.append('taxonomy_id' , this.show.taxonomy_id);   
        formData.append('term_id' , this.show.term_id);   
        await this.$store.dispatch('post/updatePost', formData,{root:true} );
        this.$toast.success('Cập nhật thành công !')
        this.$router.push({ path: `/admin/post` })
      } catch (error) {
        this.errors = this.$mixError(error)
        this.$toast.error('Cập nhật thất bại !')
      }
    },
    async uploadImage(e) {
      this.show.image = e.target.files[0]       
    }
  },
}
</script>

<style scoped lang="scss">
.was-validated .admin .form-control:invalid, .admin .form-control.is-invalid ,  .admin .form-select.is-invalid:not([multiple]):not([size]){
  background-image: none;
}
.alertSpan{
  font-size:12px;
  padding-left: 13px;
}
.editor .quillWrapper .ql-snow.ql-toolbar button svg {
  svg {
    width: 15px;
    height: 15px;
  }
}
</style>
