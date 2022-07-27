<template>
  <div class="block block--why">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-6">
          <header>
            <h2>Tại sao chọn chúng tôi</h2>
          </header>
          <p>
            Hệ thống<strong> Kết nối nhân sự IT onsite </strong>giữa các công ty
            CNTT trên toàn quốc, giúp các nhà tuyển dụng tận dụng tối đa nguồn
            lực, tiết kiệm chi phí một cách hiệu quả và chuyên nghiệp.
          </p>
          <div>
            <ul>
              <li>
                <span>1</span>
                <div>
                  <strong>Đăng yêu cầu nhân sự</strong>
                  <p>
                    Doanh nghiệp đăng tin tuyển dụng kèm yêu cầu và chi phí.
                  </p>
                </div>
              </li>
              <li>
                <span>2</span>
                <div>
                  <strong>Phê duyệt hồ sơ ứng tuyển</strong>
                  <p>
                    Sau khi tin đăng được phê duyệt, các hồ sơ sẽ được ứng tuyển
                    thông qua CMS của Hatonet.
                  </p>
                </div>
              </li>
              <li>
                <span>3</span>
                <div>
                  <strong>Hoàn thành quy trình hợp đồng</strong>
                  <p>
                    Tiến hành phê duyệt hồ sơ, đặt lịch phỏng vấn ứng viên và
                    đàm phán hợp đồng.
                  </p>
                </div>
              </li>
            </ul>
          </div>
          <div>
            <button @click="redirect">Đăng ký ngay</button>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <img src="@/assets/images/bg_about.svg" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    redirect() {
      this.$router.push({ path: '/register' })
    },
  },
}
</script>

<style lang="scss" scoped>
.block {
  padding: 4em 0;
  &--why {
    background-color: #ea530a;
    color: #fff;

    strong {
      font-size: 1.2rem;
    }

    ul {
      margin-bottom: 2em;
    }

    button {
      background-color: #fff0 !important;
      border: 2px solid #fff !important;
      color: #ffffff;
      padding: 0.6em 5em;
      border-radius: 35px;
      font-weight: 600;
    }
  }
  h2 {
    font-size: 2.2rem;
    font-weight: 800;
    margin: 0.5em 0;
  }

  ul {
    padding: 0;
    list-style: none;
    li {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 2em;
      span {
        height: 40px;
        width: 40px;
        line-height: 40px;
        display: inline-block;
        text-align: center;
        background: #fff;
        border-radius: 50%;
        color: #ea530a;
        font-size: 1.2rem;
        font-weight: 700;
        flex: none;
      }
      p {
        margin-bottom: 0;
        strong {
          font-size: 1rem !important;
        }
      }
    }
  }
}
</style>
