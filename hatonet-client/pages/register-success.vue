<template>
  <div class="block">
    <div class="container">
      <div class="card">
        <h5>Đăng ký thành công</h5>
        <p>
          Lorem ipsum dolor sit, amet consectetur adipisicing elit. Labore
          veritatis nam nobis accusantium, expedita vel, ut asperiores quae iste
          placeat modi fugit cupiditate dicta dolorum non culpa magnam assumenda
          obcaecati.
        </p>
        <div class="empty-action">
          <NuxtLink to="/admin" class="btn btn-warning">
            <span>Vào quản trị</span>
          </NuxtLink>
          <NuxtLink to="/login" class="btn">
            <span>Thoát</span>
          </NuxtLink>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import SectionSignUp from '@/components/client/SectionSignUp.vue'

export default {
  components: { SectionSignUp },
}
</script>


<style scoped lang="scss">
.block {
  background: linear-gradient(359deg, #ffffff, #fbefeb) no-repeat 0 20%;
  min-height: 80vh;
  padding: 3em 0;
}

.card {
  max-width: 800px;
  background-color: #fff;
  padding: 1.5em 2em;
  border-radius: 10px;
  box-sizing: border-box;
  box-shadow: 0px 2px 7px rgb(0 0 0 / 8%);
  margin: 0 auto;
  &__header {
    text-align: center;
    h3 {
      font-weight: 700;
      font-size: 1.3rem;
      color: #455964;
    }
    p {
      font-size: 1rem;
      color: #7e7e7e;
      font-weight: 300;
      line-height: 1.3em;
    }
  }
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
</style>

