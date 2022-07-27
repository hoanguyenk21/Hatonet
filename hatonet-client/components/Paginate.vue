<template>
  <client-only>
    <pagination
      class="paginate"
      :options="options"
      v-model="page"
      :records="total"
      :perPage="perPage "
      :currentPage="currentPage"
      @paginate="handlePaginate"
    />
  </client-only>
</template>

<script>
export default {
  name: 'Paginate',
  data: () => ({
    page: 1,
    options: {},
  }),
  props: {
    total: {
      type: [String, Number],
      default: 0,
      texts: {
        count: false,
      },
    },
    perPage: {
      type: [String, Number],
      default: 10,
    },
    currentPage: {
      type: [String, Number],
      default: 1,
    },
  },
  methods: {
    handlePaginate: function (page) {
      this.$emit('paginate', page)
    },
  },
}
</script>

<style scoped>
.paginate {
  width: 100%;
}
.paginate nav {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-direction: row-reverse;
}
</style>
>