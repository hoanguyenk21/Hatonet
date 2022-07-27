<template>
  <main>
    <section-slider />
    <section-jobs :jobs="jobs" />
    <section-why />
    <section-feature :users="users" />
    <section-price />
    <section-news :posts="posts" />
  </main>
</template>

<script>
import SectionNews from '@/components/client/SectionNews'
import SectionSlider from '@/components/client/SectionSlider'
import SectionWhy from '@/components/client/SectionWhy'
import SectionJobs from '@/components/client/SectionJobs'
import SectionCompany from '@/components/client/SectionCompany'
import SectionPrice from '@/components/client/SectionPrice'
import SectionFeature from '@/components/client/SectionFeature'
export default {
  name: 'IndexPage',
  components: {
    SectionNews,
    SectionSlider,
    SectionWhy,
    SectionJobs,
    SectionCompany,
    SectionPrice,
    SectionFeature,
  },
  asyncData: async ({ $axios, error, query }) => {
    try {
 
      const { data: users } = await $axios.get(`/api/users`)
      const { data: jobs } = await $axios.get(`/api/jobs`)
      const { data: posts } = await $axios.get(`/api/post`)
      return { users, jobs, posts }
    } catch (e) {
      error({
        statusCode: 404,
        message: '',
      })
    }
  },
}
</script>
