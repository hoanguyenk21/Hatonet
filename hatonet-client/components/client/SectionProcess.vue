<template>
  <div class="block">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-6">
          <img src="@/assets/images/bg_process.svg" />
        </div>
        <div class="col-12 col-md-6">
          <div class="title">
            <h3><strong>HATONET </strong></h3>
            <span>Giải pháp đảm bảo tiến độ công việc</span>
          </div>
          <ul>
            <li>
              <strong>Mục 1</strong>
              <span
                >Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                Repellat, quisquam?</span
              >
            </li>
            <li>
              <strong>Mục 1</strong>
              <span
                >Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                Repellat, quisquam?</span
              >
            </li>
            <li>
              <strong>Mục 1</strong>
              <span
                >Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                Repellat, quisquam?</span
              >
            </li>
            <li>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi
              similique facere dicta modi. Quae minus recusandae praesentium
              maxime eveniet illo!
            </li>
          </ul>
          <ul class="static">
            <li>
              <span>Doanh nghiệp</span>
              <strong>2000</strong>
            </li>
            <li>
              <span>Việc làm</span>
              <strong>12000</strong>
            </li>
            <li>
              <span>Hài lòng</span>
              <strong>99.9%</strong>
            </li>
          </ul>
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
  padding: 5em 0;
  background: #fff;
}
.title {
  font-weight: 700;
  font-size: 2rem;
  line-height: 0.7em;
  margin-bottom: 0.8em;

  span {
    font-size: 1.8rem;
    font-weight: 200;
    color: #7e7e7e;
  }
}

ul {
  list-style: none;
  padding: 0;
  li {
    margin-bottom: 0.5em;
  }
}

.static {
  display: flex;
  justify-content: space-around;
  list-style: none;
  margin: 3em 0 0;
  padding: 0;
  li {
    text-align: right;
    font-size: 1.1rem;
  }
  span {
    font-size: 1rem;
    font-weight: 500;
  }
  strong {
    font-size: 2.5rem;
    display: block;
    color: #000;
  }
}
</style>
