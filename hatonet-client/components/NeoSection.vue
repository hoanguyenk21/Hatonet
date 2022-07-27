<template>
  <div class="neo">
    <nuxt-link to="#jobs">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        width="16"
        height="16"
        fill="currentColor"
        class="bi bi-chevron-double-down"
        viewBox="0 0 16 16"
      >
        <path
          fill-rule="evenodd"
          d="M1.646 6.646a.5.5 0 0 1 .708 0L8 12.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"
        />
        <path
          fill-rule="evenodd"
          d="M1.646 2.646a.5.5 0 0 1 .708 0L8 8.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"
        />
      </svg>
    </nuxt-link>
  </div>
</template>

<script>
export default {}
</script>

<style scoped lang="scss">
.neo {
  display: flex;
  justify-content: center;
  a {
    text-decoration: none;
    position: relative;
    animation-duration: 0.8s;
    animation-name: changewidth;
    animation-iteration-count: infinite;
    animation-direction: alternate;
    svg {
      fill: #455964;
      width: 40px;
      height: 40px;
    }
  }
  @keyframes changewidth {
    from {
      top: 0px;
    }

    to {
      top: 10px;
    }
  }
}
</style>
