<template>
  <main>
    <div class="block-contact">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-6">
            <div class="block-contact__title"> 
              <h3>Thông tin liên hệ</h3>
              <p> 
                Hãy để lại thông tin của bạn hoặc thắc mắc(nếu có), Hatonet sẽ liên lạc lại sớm nhất.
              </p>
            </div>
            <div>
              <validation-observer v-slot="{ valid, handleSubmit }">
                <div class="input">
                  <validation-provider v-slot="{ errors }" rules="required">
                    <input v-model="messageData.name" placeholder="Họ tên" />
                    <span class="message">{{ errors[0] }}</span>
                  </validation-provider>
                </div>
                <div class="input">
                  <validation-provider v-slot="{ errors }" rules="required|email">
                    <input v-model="messageData.email" placeholder="Email" />
                    <span class="message">{{ errors[0] }}</span>
                  </validation-provider>
                </div>
                <div class="input">
                  <validation-provider v-slot="{ errors }" rules="required|phone">
                    <input v-model="messageData.phone" placeholder="Số điện thoại" />
                    <span class="message">{{ errors[0] }}</span>
                  </validation-provider>
                </div>
                <div class="input">
                  <validation-provider v-slot="{ errors }" rules="required">
                    <textarea v-model="messageData.message" placeholder="Nội dung" />
                    <span class="message">{{ errors[0] }}</span>
                  </validation-provider>
                </div>
                <div class="btn-submit">
                  <button class="submit" type="submit" @click="handleSubmit(onSubmit(valid))">
                    Gửi yêu cầu
                  </button>
                </div>
              </validation-observer>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <img src="@/assets/images/contact.svg" />
          </div>
        </div>
      </div>
    </div>
    <section-contact-help />
    <section-faqs />
  </main>
</template>
<script>
import { mapState } from 'vuex'
import SectionFaqs from '@/components/client/SectionFaqs.vue'
import SectionContactHelp from '@/components/client/SectionContactHelp.vue'
export default {
  components: {
    SectionFaqs,
    SectionContactHelp,
  },
        computed: {
    ...mapState('mailClient', ['send']),
  },
  data() {
    return {
      messageData: {},
    }
  },
  methods: {
    async onSubmit() {
      try {
        await this.$store.dispatch('mailClient/MailSend', this.messageData)
        this.$toast.success('Gửi thành công!')
      } catch (error) {
        this.$toast.error('Gửi thất bại!')
      }
    },
  },
}
</script>

<style scoped lang="scss">
.message {
  color: red;
  margin: 20px;
}

.block-contact {
  background: linear-gradient(359deg, #fcf3f1, #fcf2ef) no-repeat 0 20%;
  padding: 5em 0;

  &__title {
    padding: 0 0.3em;

    h3 {
      font-size: 2rem;
      font-weight: 800;
      color: #455a64;
    }

    p {
      font-size: 1.2rem;
      line-height: 1.9rem;
      font-weight: 300;
      color: #455a64;
    }
  }
}
.submit {
  background: rgba(0, 0, 0, 0);
  color: #455a64;
  border: 2px solid #455a64 !important;
  text-decoration: none;
  padding: 0.5em 3em;
  border-radius: 30px;
  font-weight: 700;
  margin: 1em 0;
}

.input {
  margin-bottom: 1em;
}

input {
  height: 40px;
  width: 100%;
  box-sizing: border-box;
  border-radius: 20px;
  border: 1px solid #fff;
  padding-left: 15px;
}

textarea {
  height: 90px;
  width: 100%;
  box-sizing: border-box;
  border-radius: 20px;
  border: 1px solid #fff;
  padding-left: 15px;
  padding-top: 10px;
}
</style>
