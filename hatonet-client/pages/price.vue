<template>
  <div class="page-price">
    <section-price />
    <section-process />
    <section-contact-me />
    <section-faqs />
  </div>
</template>

<script>
import SectionPrice from '@/components/client/SectionPrice'
import SectionFaqs from '@/components/client/SectionFaqs'
import SectionContactMe from '@/components/client/SectionContactMe'
import SectionProcess from '@/components/client/SectionProcess.vue'

export default {
  components: {
    SectionPrice,
    SectionFaqs,
    SectionContactMe,
    SectionProcess,
  },
}
</script>

<style>
</style>
