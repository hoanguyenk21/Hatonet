<template>
  <div class="block block--faqs">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-6">
          <h4 class="faqs-title">
            <span>
              <svg
                width="68"
                height="68"
                viewBox="0 0 68 68"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M67.5127 40.5305L63.2178 35.5794C66.3134 31.7069 68 26.919 68 21.9141C68 9.83065 58.1695 0 46.0859 0C34.0024 0 24.1719 9.83065 24.1719 21.9141C24.1719 33.9975 34.0025 43.8281 46.0859 43.8281H66.0078C66.788 43.8281 67.4964 43.3727 67.8202 42.6631C68.1441 41.9533 68.0239 41.1199 67.5127 40.5305ZM46.0859 35.4609C44.9857 35.4609 44.0938 34.569 44.0938 33.4688C44.0938 32.3685 44.9857 31.4766 46.0859 31.4766C47.1862 31.4766 48.0781 32.3685 48.0781 33.4688C48.0781 34.569 47.1863 35.4609 46.0859 35.4609ZM51.6286 21.1386C50.6579 22.161 49.4213 22.8889 48.0783 23.2536V27.4372C48.0783 28.5374 47.1863 29.4294 46.0861 29.4294C44.9859 29.4294 44.0939 28.5374 44.0939 27.4372V21.5282C44.0939 20.428 44.9859 19.5361 46.0861 19.5361C47.0985 19.5361 48.0407 19.1308 48.7393 18.3952C49.4371 17.6602 49.7923 16.696 49.7396 15.6801C49.6409 13.7781 48.0696 12.2579 46.1626 12.2195C46.1376 12.219 46.1126 12.2188 46.0877 12.2188C44.2661 12.2188 42.7148 13.559 42.4628 15.3647C42.4393 15.5328 42.4275 15.7053 42.4275 15.8775C42.4275 16.9777 41.5355 17.8697 40.4353 17.8697C39.3351 17.8697 38.4431 16.9777 38.4431 15.8775C38.4431 15.5218 38.4679 15.1641 38.5167 14.814C39.0509 10.986 42.3768 8.15668 46.2428 8.23597C50.2284 8.31632 53.5121 11.4955 53.7187 15.4736C53.8285 17.5914 53.0862 19.6034 51.6286 21.1386Z"
                ></path>
                <path
                  d="M28.5547 44.0937H15.2735C14.1733 44.0937 13.2813 43.2018 13.2813 42.1015C13.2813 41.0013 14.1733 40.1094 15.2735 40.1094H27.6774C23.5608 35.945 20.8418 30.3962 20.2925 24.2319C8.96342 25.0646 3.41212e-05 34.548 3.41212e-05 46.0859C3.41212e-05 51.0908 1.68662 55.8786 4.78221 59.7513L0.487323 64.7024C-0.0238721 65.2918 -0.144067 66.1252 0.179862 66.835C0.503792 67.5446 1.21208 68 1.99222 68H21.9141C33.4522 68 42.9354 59.0366 43.7681 47.7076C38.81 47.2657 34.2505 45.4195 30.4886 42.5724C30.2768 43.4449 29.4925 44.0937 28.5547 44.0937ZM28.5547 52.0625H15.2735C14.1733 52.0625 13.2813 51.1705 13.2813 50.0703C13.2813 48.9701 14.1733 48.0781 15.2735 48.0781H28.5547C29.6549 48.0781 30.5469 48.9701 30.5469 50.0703C30.5469 51.1705 29.6549 52.0625 28.5547 52.0625Z"
                ></path>
              </svg>
            </span>

            Câu hỏi thường gặp
          </h4>
          <div class="accordion">
            <div
              class="accordion-item"
              v-for="item in 4"
              :key="item"
              :class="{ show: item === 1 }"
            >
              <header class="accordion-header">
                <button class="accordion-button" type="button">
                  <div class="icon">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="16"
                      height="16"
                      fill="currentColor"
                      class="bi bi-question"
                      viewBox="0 0 16 16"
                    >
                      <path
                        d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"
                      />
                    </svg>
                  </div>
                  <span class="title">Accordion Item #1</span>
                </button>
              </header>
              <div class="accordion-collapse collapse">
                <div class="accordion-body">
                  <strong>This is the first item's accordion body.</strong> It
                  is shown by default, until the collapse plugin adds the
                  appropriate classes that we use to style each element. These
                  classes control the overall appearance, as well as the showing
                  and hiding via CSS transitions. You can modify any of this
                  with custom CSS or overriding our default variables. It's also
                  worth noting that just about any HTML can go within the
                  <code>.accordion-body</code>, though the transition does limit
                  overflow.
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <img src="@/assets/images/bg_faqs.svg" />
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
  padding: 5em 0;
}
.faqs-title {
  font-size: 1.8rem;
  margin-bottom: 1em;
  font-weight: 800;
  padding: 0 0.4em;
  color: #455a64;

  svg {
    fill: #455a64;
    width: 50px;
    height: 50px;
  }
}
button {
  width: 100%;
  width: 100%;
  display: flex;
  flex-direction: row;
  border: none;
  justify-content: space-between;
  background: transparent;
  align-items: center;
  padding: 0;

  span {
    padding-right: 20px;
    font-weight: 700;
    color: #36474f;
    font-size: 1.2rem;
  }
}
.icon {
  height: 35px;
  width: 35px;
  line-height: 35px;
  background-color: #ebebeb;
  color: #36474f;
  border-radius: 50%;
  svg {
    width: 23px;
    height: 23px;
  }
}
.accordion-body {
  padding: 1em 0.5em 1em 3em;
  font-weight: 400;
}
.accordion-collapse {
  height: 0;
  opacity: 0;
  visibility: hidden;
}
.accordion-item {
  margin-bottom: 1em;
  padding: 0.8em;
  border-radius: 35px;
  border: 2px solid #ebebeb;
}

.show {
  background-color: #ebebeb;
  color: #455a64;
  .icon {
    background-color: #455a64;
    color: #fff;
  }
  .title {
    color: #455a64;
  }
  .accordion-collapse {
    height: auto;
    opacity: 1;
    visibility: visible;
  }
}
</style>
