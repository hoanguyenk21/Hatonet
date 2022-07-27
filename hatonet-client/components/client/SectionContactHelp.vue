<template>
  <div class="block block--contact">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12 col-md-6">
          <h4>Hatonet Help Center</h4>
          <p>Hoặc liên hệ đến bộ phận chăm sóc khách hàng bằng cách</p>
        </div>
        <div class="col-12 col-md-6 right">
          <div class="phone">
            <a href="tel:02462.911.388"
              ><strong>Hotline : 02462.911.388</strong></a
            >
            <p><small>Email: cskh@hatonet.com</small></p>
            <!-- <p>Đường dây nóng: <a href="tel:0942389597">098x.789.789</a></p> -->
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

a {
  padding: 0.5em 3em;
  border: 2px solid #fff;
  border-radius: 35px;
  font-size: 1.3rem;
  background: transparent;
  color: #fff;
  text-decoration: none;
  margin-bottom: 0.1em;
  display: inline-block;
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
