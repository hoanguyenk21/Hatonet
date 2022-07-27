<template>
  <div class="block block--contact">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12 col-md-6">
          <h4>Liên hệ với chúng tôi</h4>
          <p>
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Animi,
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. At,
            veritatis? sint?
          </p>
        </div>
        <div class="col-12 col-md-6 right">
          <div class="phone">
            <button>Liên hệ ngay</button>
            <p>Hotline: <a href="tel:0942389597">098x.789.789</a></p>
          </div>
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
  padding: 4em 0;
  background: #35474f;
  color: #fff;
  h4 {
    font-size: 2rem;
    font-weight: 700;
  }
}

button {
  padding: 0.3em 3em;
  border: 2px solid #fff;
  border-radius: 35px;
  font-size: 1.3rem;
  background: transparent;
  color: #fff;
}

.right {
  display: flex;
  justify-content: flex-end;
}

.phone {
  text-align: center;
  padding: 0 5em;
  p {
    padding-top: 0.5em;
    letter-spacing: 1px;
  }
  a {
    color: #fff;
    font-size: 1.1rem;
  }
}
</style>
