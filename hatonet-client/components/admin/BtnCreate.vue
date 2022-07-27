<template>
  <nuxt-link class="btn btn-dark btn-create" :to="url">
    <svg
      data-v-394cbdae=""
      xmlns="http://www.w3.org/2000/svg"
      width="16"
      height="16"
      fill="currentColor"
      viewBox="0 0 16 16"
      class="bi bi-plus-circle"
    >
      <path
        data-v-394cbdae=""
        d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"
      ></path>
      <path
        data-v-394cbdae=""
        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"
      ></path>
    </svg>
    <span class="pr-2">{{ label }}</span>
  </nuxt-link>
</template>

<script>
export default {
  name: 'BtnCreate',
  props: {
    label: {
      type: String,
      default: '',
    },
    url: {
      type: String,
      default: '/admin/post/add',
      required: true,
    },
  },
}
</script>

<style scoped lang="scss">
.btn-create {
  display: inline-flex;
  gap: 5px;
  max-width: 200px;
  padding: 0.3em 2em;
  svg {
    width: 22px;
    height: 22px;
  }
}
</style>
