<template>
  <div class="page-company">
    <section-company-feature :users="users" />
    <section-offer />
    <section-company :users="users"/>
    <section-faqs />
  </div>
</template>

<script>
import SectionFaqs from '@/components/client/SectionFaqs.vue'
import SectionOffer from '@/components/client/SectionOffer.vue'
import SectionCompany from '@/components/client/SectionCompany.vue'
import SectionCompanyFeature from '@/components/client/SectionCompanyFeature'
export default {
  components: {
    SectionFaqs,
    SectionOffer,
    SectionCompany,
    SectionCompanyFeature,
  },
  asyncData: async ({ $axios, error }) => {
    try {
      const { data:users} = await $axios.get(`/api/users`)
      return { users}
    } catch (e) {
      error({
        statusCode: 404,
        message: '',
      })
    }
  },
}
</script>

<style lang="scss" scoped>
</style>
