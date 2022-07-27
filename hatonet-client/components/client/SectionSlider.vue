<template>
  <div class="slider">
    <div class="container align-items-center">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-7">
          <small>NHANH CHÓNG - DỄ DÀNG - HIỆU QUẢ</small>
          <h1>Nền tảng kết nối nhân sự onsite toàn diện</h1>
          <p>
            Hệ thống kết nối nhân sự IT onsite doanh nghiệp hàng đầu Việt Nam.
          </p>
          <div>
            <nuxt-link to="/jobs">
              <button class="btn-jobs">Tìm công việc</button></nuxt-link
            >
            <nuxt-link to="/register">
              <button class="btn-white">Đăng ký ngay</button></nuxt-link
            >
          </div>
          <div class="line">
            <strong>Được tin cậy bởi</strong>
            <div class="trust">
              <img
                width="100"
                src="https://upload.wikimedia.org/wikipedia/commons/7/7c/Techcombank_logo.png"
              />
              <img
                width="100"
                src="https://hanoi.fpt.edu.vn/wp-content/uploads/2018/03/FPT-Software-Ngang-2017.png"
                alt=""
              />
              <img
                width="100"
                src="https://upload.wikimedia.org/wikipedia/commons/7/7c/Techcombank_logo.png"
              />
              <img
                width="100"
                src="https://hanoi.fpt.edu.vn/wp-content/uploads/2018/03/FPT-Software-Ngang-2017.png"
                alt=""
              />
            </div>
          </div>
        </div>
        <div class="col-12 col-md-12 col-lg-5">
          <div class="bg-slider">
            <img src="@/assets/images/bg_slider.svg" />
          </div>
        </div>
      </div>
      <neo-section />
    </div>
  </div>
</template>

<script>
import NeoSection from '@/components/NeoSection.vue'
export default {
  components: { NeoSection },
}
</script>

<style lang="scss" scoped>
h1 {
  color: #253236;
}
small {
  font-size: 1rem;
  color: #ff6116;
  margin-top: 2em;
  display: inherit;
  font-weight: 800;
  padding: 0 0.5em;
}
p {
  font-size: 1.5rem;
  font-weight: 200;
  color: #253236;
  margin-bottom: 1.5em;
}

.slider {
  padding: 4em 0px;
  background: linear-gradient(359deg, #ffffff, #fbefeb) no-repeat 0 20%;
  color: #253235;
  h1 {
    font-size: 3rem;
    font-weight: 900;
    margin: 0.5em 0;
    text-shadow: 0.2px 0.2px 3px #0001;
    color: #253235;
  }
  small {
    font-size: 1.1rem;
    margin-top: 2em;
    display: inherit;
    padding: 0;
  }
  p {
    font-size: 1.3rem;
    font-weight: 400;
    color: #455a64;
    margin-bottom: 1.5em;
  }
  button {
    padding: 0.6em 5em;
    border: none;
    border-radius: 35px;
    background-color: #fff;
    font-weight: bold;
  }
  .btn-jobs {
    background: #ff6600;
    border: 2px solid #ff6600 !important;
    color: #ffffff !important;
  }
  .line {
    color: #fff;
    margin: 2em 0.3em;
    strong {
      margin-bottom: 1.5em;
      display: inline-block;
      font-weight: 700;
      color: #585858;
      font-size: 0.8rem;
      padding: 0 0.7em;
    }
  }
  .trust {
    display: flex;
    gap: 1em;
    align-items: center;
    overflow: hidden;
    img {
      filter: grayscale(100%);
      &:hover{
        filter: none;
        cursor: pointer;
      }
    }
  }

  .btn-white {
    background-color: #0000 !important;
    border: 2px solid #253235 !important;
    color: #253235;
    margin-left: 1em;
  }
}
.bg-slider {
  img {
    -webkit-transform: scaleX(-1);
    transform: scaleX(-1);
  }
}
</style>
