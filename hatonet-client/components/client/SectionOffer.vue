<template>
  <div class="block">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12 col-md-5">
          <img src="@/assets/images/bg_offer.svg" />
        </div>
        <div class="col-12 col-md-7">
          <h3>Tham gia ..... cùng chúng tôi</h3>
          <p class="description">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime,
            delectus!, Lorem, ipsum dolor sit amet consectetur adipisicing elit.
            Reiciendis vitae quaerat, dolor totam unde qui quo. Voluptates sunt
            ab nobis?
          </p>

          <nuxt-link class="btn btn--auth" to="/register">Tham gia </nuxt-link>
          <nuxt-link class="btn btn--jobs" to="/jobs">Tìm việc ngay</nuxt-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {}
</script>

<style scoped lang="scss">
.block {
  background: #fff;
  padding: 3em 0;
  h3 {
    font-size: 2rem;
    font-weight: 800;
    color: #455a64;
  }
}
.description {
  font-size: 1.4rem;
  line-height: 1.9rem;
  font-weight: 200;
  color: #7e7e7e;
  margin-bottom: 1em;
}
.btn {
  text-decoration: none;
  padding: 0.6em 4em;
  border-radius: 30px;
  font-weight: 700;
  color: #ffffff;
  background: #f60;
  border: 2px solid #f60;
  margin-right: 1em;
  min-width: 200px;
  display: inline-block;
  text-align: center;
  font-size: 1rem;
  &--jobs {
    color: #f60;
    background: #fff !important;
  }
  &--auth {
    color: #ffffff;
    background: #f60;
  }
}
</style>
