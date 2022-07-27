<template>
  <img
    :src="src"
    :alt="alt"
    :class="[{ rounded, block }]"
    v-bind="$attrs"
    @error="handleError"
  />
</template>


<script>
export default {
  name: 'SectionImage',
  props: {
    path: {
      type: String,
      required: false,
      default: '',
    },
    alt: {
      type: String,
      required: false,
      default: '',
    },
    placeholder: {
      type: String,
      required: false,
      default: '',
    },
    rounded: {
      type: Boolean,
    },
    block: {
      type: Boolean,
    },
  },
  computed: {
    src() {
      return this.path || this.placeholderImage
    },
    placeholderImage() {
      return require('@/assets/images/avatar/imagesav.png')
    },
  },
  methods: {
    handleError(e) {
      e.target.src = this.placeholderImage
    },
  },
}
</script>

