<template>
  <div class="page page-error">
    <div class="container">
      <section class="empty" v-if="error.statusCode === 404">
        <div class="row align-items-center">
          <div class="col-12 col-md-6">
            <h2 class="title text-muted">Oops…</h2>
            <p class="subtitle text-muted">
              Trang chúng tôi đang xây dựng hoặc không tồn tại
            </p>
            <div class="empty-action">
              <NuxtLink to="/" class="btn btn-warning">
                <span>Tiếp tục khám phá</span>
              </NuxtLink>
              <NuxtLink to="/login" class="btn">
                <span>Đăng nhập</span>
              </NuxtLink>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <img :src="require('@/assets/images/error_404.svg')" alt="404" />
          </div>
        </div>
      </section>
      <section v-else-if="error.statusCode === 500">
        <div class="row align-items-center">
          <div class="col-12 col-md-6">
            <h2 class="title text-muted">Error 500</h2>
            <p class="subtitle text-muted">Có lỗi xảy ra từ máy chủ</p>
            <div class="empty-action">
              <NuxtLink to="/" class="btn btn-warning">
                <span>Tiếp tục khám phá</span>
              </NuxtLink>
              <NuxtLink to="/login" class="btn">
                <span>Đăng nhập</span>
              </NuxtLink>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="bg-error">
              <img :src="require('@/assets/images/error_500.svg')" alt="500" />
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</template>

<script>
export default {
  props: ['error'],
  layout: 'error', // you can set a custom layout for the error page
  head() {
    return {
      title: 'Không tìm thấy',
      link: [{ rel: 'stylesheet', href: '/css/admin.css' }],
      bodyAttrs: {
        class: 'd-flex flex-column theme-light',
      },
    }
  },
}
</script>

<style scoped lang="scss">
.page-error {
  padding: 5em 0;
  background: linear-gradient(359deg, #ffffff, #fbefeb) no-repeat 0 20%;

  .title {
    font-size: 3rem;
    font-weight: 800;
  }

  .subtitle {
    font-size: 1.5rem;
    color: #455964;
    font-weight: 200;
    margin-bottom: 3em;
  }

  .btn {
    padding: 0.5em 2.5em;
    border: 2px solid #455964;
    text-decoration: none;
    color: #455964;
    border-radius: 30px;
    min-width: 180px;
    display: inline-block;
    text-align: center;
    margin-right: 1em;
  }
  .btn-warning {
    background-color: #455964;
    color: #fff;
  }
}

.bg-error {
  width: 80%;
}
</style>
