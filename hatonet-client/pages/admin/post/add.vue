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
                v-model="post.title"
                
              />          
                <span v-if="errors && errors.title" class="text-danger alertSpan">{{ errors.title[0] }}</span>   
            </div>
            <div class="mb-3">
              <label class="form-label required">Đường dẫn</label>
              <input
                type="text"
                class="form-control"
                placeholder="Đường dẫn"
                v-model="post.slug"
                
              />
              <span class="text-danger alertSpan" v-if="errors && errors.title">
                {{ errors.slug[0] }}
              </span>
            </div>
            <div class="mb-3">
              <label class="form-label">image</label>
              <input
                type="file"
                class="form-control"
                @change="uploadImage($event)"
              />
            </div>
              <div class="mb-3 editor">
              <label class="form-label required">
                <span>Mô tả</span>
              </label>
              <!-- <client-only>
                <VueEditor 
                  name="description"
                  v-model="post.description"     
                  :editor-toolbar="customToolbar"             
                />
              </client-only> -->
              <TextEditor></TextEditor>
              <textarea  class="form-control" name="" id="" cols="95" rows="5"  v-model="post.description"     ></textarea>
               <span class="text-danger alertSpan" v-if="errors && errors.description">
                {{ errors.description[0] }}
              </span>
            </div>
            <div class="mb-3 editor">
              <label class="form-label">
                <span>Nội dung</span>
              </label> 
              <!-- <client-only>
               <VueEditor  name="content" v-model="post.content" :editor-toolbar="customToolbar"/>
              </client-only> -->
            <textarea  class="form-control" name="" id="" cols="95" rows="5"  v-model="post.content"     ></textarea>
                <span class="text-danger alertSpan" v-if="errors && errors.content">
                {{ errors.content[0] }}
              </span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-4 col-xl-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="mb-3">
              <button class="btn btn-dark btn-block" @click="addPost">
                Tạo mới
              </button>
            </div>
            <!-- <div class="mb-3">
                 <div class="form-group">
                  <label class="form-label required">Trạng thái</label>
                  <select  class="form-select" v-model="post.status" >
                    <option v-for="status in options.status" :key="status.id" :value="status.value"
                      :selected="status.id">
                      {{ status.name }}
                    </option>
                  </select>
                </div>
               <span class="text-danger alertSpan" v-if="errors && errors.status">
                {{ errors.status[0] }}
              </span>
            </div> -->
            <div class="mb-3">
               <div class="form-group">
                  <label class="form-label">Term</label>
                  <select class="form-select" v-model="post.term_id" >
                    <option v-for="(term, index) in items" v-bind:key="index" :value="term.id"
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
                  <select class="form-select" v-model="post.taxonomy_id">
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
import { STATUS } from '../../../constants/common'
import TextEditor from '@/components/TextEditor.vue'
export default {
  name: 'AdminAreaPost',
  layout: 'admin.root',
  computed: { 
    ...mapState('category' , ['categories']),
    ...mapState('term' , ['items']) 
    },
     components: {
      TextEditor
    },
  data: () => ({
      customToolbar: [
      ['bold', 'italic', 'underline'],
      [{ list: 'ordered' }, { list: 'bullet' }],
      ['image'],
    ],
    post: {},
    errors: {},
    options: {
      status: STATUS, 
    },
    image: null,
  }),
  async fetch({store}) {
    try {
      await store.dispatch('category/getAll');
      await store.dispatch('term/getAll')
    } catch (error) { 
      this.$mixError(error)
    }
  },
  methods: {
    async addPost() {
      try {
        this.post.user_id = this.$cookies.get('_user').id
        this.post.status = 'active'
        await this.$store.dispatch('post/createPost', this.post)
        await this.$router.push({ path: '/admin/post' })
        this.$toast.success('Tạo mới thành công !')
      } catch (error) {
        this.errors = this.$mixError(error);
        this.$toast.error('Tạo mới thất bại !')
      }
    },
    uploadImage(e) {
      this.post.image = e.target.files[0]
    },
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
