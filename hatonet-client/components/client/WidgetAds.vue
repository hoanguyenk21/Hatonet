<template>
  <div class="aside aside--no">
    <img src="https://www.devwork.vn/_nuxt/img/register.1aa564b.png" />
  </div>
</template>

<script>
export default {}
</script>

<style scoped lang="scss">
.aside {
  background-color: #fff;
  border-radius: 20px;
  padding: 1em 1.5em;
  margin-bottom: 2em;
  ul {
    padding: 0;
    list-style: none;
    margin: 1em 0;
    li {
      padding: 0.6em 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px dashed #ddd;
      .label {
        height: 20px;
        width: 20px;
        font-size: 0.8rem;
        line-height: 20px;
        background: #dddddd;
        text-align: center;
        border-radius: 50%;
        color: #455a64;
      }

      a {
        text-decoration: none;
        font-size: 1rem;
        color: #455a64;
        font-size: 500;
      }
      svg {
        fill: #ddd;
        position: relative;
        top: -3px;
        width: 20px;
        height: 20px;
      }

      &:last-child {
        border-bottom: none;
      }
    }
  }

  img {
    width: 100%;
    border-radius: 20px;
  }

  &--no {
    padding: 0;
  }
}
</style>
