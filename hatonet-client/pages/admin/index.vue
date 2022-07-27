<template>
  <main>
    <div class="row mb-4">
      <div class="col-12">
        <div class="card card-md">
          <div class="card-stamp card-stamp-lg">
            <div class="card-stamp-icon bg-orange">
              <i class="ti ti-building-skyscraper"></i>
            </div>
          </div>
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-10">
                <div class="title-company">
                  <h3>Công ty ABC <sup>Basic</sup></h3>
                  <div class="confirm-company">
                    <svg
                      data-v-7bda3609=""
                      xmlns="http://www.w3.org/2000/svg"
                      width="16"
                      height="16"
                      fill="currentColor"
                      viewBox="0 0 16 16"
                      class="bi bi-patch-check-fill"
                    >
                      <path
                        data-v-7bda3609=""
                        d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"
                      ></path>
                    </svg>
                    <span>Đã xác thực </span>
                  </div>
                </div>
                <div class="markdown text-muted">
                  <ul>
                    <li>Số tin đăng</li>
                    <li>Lượt xem tin</li>
                    <li>Ghé thăm trang</li>
                    <li>Theo dõi</li>
                  </ul>
                </div>
                <div class="mt-3">
                  <nuxt-link
                    to="/admin/product/add"
                    class="jobs-create text-orange"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="16"
                      height="16"
                      fill="currentColor"
                      class="bi bi-plus-circle"
                      viewBox="0 0 16 16"
                    >
                      <path
                        d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"
                      />
                      <path
                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"
                      />
                    </svg>
                    <span> Thêm tin tuyển dụng </span>
                  </nuxt-link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <header>
          <h2 class="my-3">Thống kê</h2>
        </header>
        <div class="row row-cards">
          <div class="col-sm-6 col-lg-3">
            <div class="card card-sm">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-auto">
                    <span class="bg-orange text-white avatar">
                      <i class="ti ti-shopping-cart"></i>
                    </span>
                  </div>
                  <div class="col">
                    <strong>Nhân sự phù hợp</strong>
                    <div class="text-muted">
                      <strong class="text-orange">32</strong>
                      <small>Nhân sự</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="card card-sm">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-auto">
                    <span class="bg-orange text-white avatar">
                      <i class="ti ti-brand-twitter"></i>
                    </span>
                  </div>
                  <div class="col">
                    <strong class="font-weight-medium">Nhân sự Onboard</strong>
                    <div class="text-muted">
                      <strong class="text-orange">32</strong>
                      <small>Nhân sự</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="card card-sm">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-auto">
                    <span class="bg-orange text-white avatar">
                      <i class="ti ti-circle-check fs-1"></i>
                    </span>
                  </div>
                  <div class="col">
                    <strong class="font-weight-medium">Đã xác nhận </strong>
                    <div class="text-muted">
                      <strong class="text-orange">32</strong>
                      <small>Nhân sự</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="card card-sm">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-auto">
                    <span class="bg-orange text-white avatar">
                      <i class="ti ti-help fs-1"></i>
                    </span>
                  </div>
                  <div class="col">
                    <strong class="font-weight-medium">Chờ xác nhận</strong>
                    <div class="text-muted">
                      <strong class="text-orange">132</strong>
                      <small>Nhân sự</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-4">
        <div class="card">
          <div class="card-title px-3 pt-3">
            <span class="header">THÀNH VIÊN</span>
            <div class="subheader">New clients</div>
          </div>
          <div class="card-body card-body-scrollable" style="height: 18rem">
            <div class="divide-y">
              <div class="row" v-for="item in 8" :key="item">
                <div class="col-auto">
                  <span class="avatar bg-dark">JL</span>
                </div>
                <div class="col">
                  <div class="text-truncate">
                    <strong>Jeffie Lewzey</strong> commented on your
                    <strong>"I'm not a witch."</strong> post.
                  </div>
                  <div class="text-muted">yesterday</div>
                </div>
                <div class="col-auto align-self-center">
                  <div class="badge bg-primary"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-8">
        <div class="card">
          <div class="card-title px-3 pt-3">
            <span class="header">VIỆC ĐANG TUYỂN</span>
            <div class="subheader">New clients</div>
          </div>
          <div class="card-body card-body-scrollable" style="height: 18rem">
            <div class="divide-y">
              <div class="row" v-for="item in 8" :key="item">
                <div class="col-auto">
                  <span class="avatar bg-green-a700">JL</span>
                </div>
                <div class="col">
                  <div class="text-truncate">
                    <nuxt-link to="/"
                      ><i class="ti ti-link fs-4"></i
                    ></nuxt-link>
                    <strong>Jeffie Lewzey</strong>
                  </div>
                  <div class="text-muted">26 Nov 2019</div>
                </div>
                <div class="col-auto align-self-center">
                  <div class="badge bg-primary"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
export default {
  name: 'AdminArea',
  layout: 'admin.root',
  // middleware: ["auth"],
  methods: {},
}
</script>

<style lang="scss" scoped>
.jobs-create {
  display: flex;
  align-items: center;
  gap: 10px;
  text-decoration: none;
  svg {
    width: 25px;
    height: 25px;
  }
}

.title-company {
  margin-bottom: 1em;
  h3 {
    font-weight: 800;
    margin: 0;
    font-size: 1.5rem;
    line-height: 1em;
    display: block;
  }
  sup {
    background: #f60;
    font-weight: normal;
    font-size: 0.8rem;
    color: #fff;
    border-radius: 38px;
    height: 38px;
    line-height: 38px;
    padding: 0 1em;
  }
}

.confirm-company {
  margin-bottom: 0.5em;
  display: flex;
  align-items: center;
  gap: 5px;
  svg {
    width: 20px;
    height: 20px;
    fill: #4caf50;
  }
}
</style>
