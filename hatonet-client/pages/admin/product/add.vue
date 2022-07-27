<template>
  <section>
    <validation-observer v-slot="{ valid, handleSubmit }">
      <div class="card mb-2">
        <div class="card-control">
          <ul class="step">
            <li class="active" title="1">
              <span>Thông tin</span>
            </li>
            <li title="2">
              <span>Đăng tin</span>
            </li>
          </ul>
          <div class="btn-request">
            <button class="btn-post" @click="handleSubmit(onSubmit(valid))">Tiếp Theo</button>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <section title="Thông tin" :selected="true">
            <div class="row">
              <div class="col-lg-8">
                <div class="mb-3">
                  <div class="row">
                    <div>
                      <div class="mb-3 mt-3">
                        <label class="form-label required">Tiêu đề</label>
                        <validation-provider v-slot="{ errors }" rules="required">
                          <input type="text" class="form-control" v-model="product.title" @input="titleToSlug" />
                          <span class="message">{{ errors[0] }}</span>
                        </validation-provider>
                      </div>
                    </div>
                    <div>
                      <label class="form-label required">Slug</label>
                      <validation-provider v-slot="{ errors }" rules="required">
                        <input type="text" class="form-control" v-model="product.slug" disabled >
                        <span class="message">{{ errors[0] }}</span>
                      </validation-provider>
                    </div>
                    <!-- /form-group -->
                  </div>
                </div>
                <div>
                  <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                      <label class="form-label required">Tỉnh / thành phố</label>
                      <validation-provider v-slot="{ errors }" rules="required">
                        <select class="form-select" v-model="product.meta._address">
                          <template v-for="location in options.location">
                            <option :key="location" :value="location.id">
                              {{ location.name }}
                            </option>
                          </template>
                        </select>
                        <span class="message">{{ errors[0] }}</span>
                      </validation-provider>
                    </div>
                    <!-- /form-group -->
                    <div class="col-12 col-lg-4 mb-3">
                      <div class="form-label required">Kinh nghiệm</div>
                      <validation-provider v-slot="{ errors }" rules="required">
                        <select class="form-select" v-model="product.meta._number_Level">
                          <option value="" disabled selected>
                            Số năm làm việc
                          </option>
                          <template v-for="exp in options.exp">
                            <option :key="exp" :value="exp.id">
                              {{ exp.name }}
                            </option>
                          </template>
                        </select>
                        <span class="message">{{ errors[0] }}</span>
                      </validation-provider>
                    </div>
                    <div class="col-12 col-lg-4 mb-3">
                      <div class="form-label required">Giá bán / Người / Tháng</div>
                      <validation-provider v-slot="{ errors }" rules="required">
                        <input type="" min="1" class="form-control" v-model="product.price_sale"
                          oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                        <span class="message">{{ errors[0] }}</span>
                      </validation-provider>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                      <label class="form-label required">Hạn ứng tuyển</label>
                      <validation-provider v-slot="{ errors }" rules="required">
                        <flat-pickr v-model="product.meta._dateline" :config="{ dateFormat: 'd/m/Y', minDate: 'today' }"
                          placeholder="dd/mm/yyyy" />
                        <span class="message">{{ errors[0] }}</span>
                      </validation-provider>
                    </div>
                    <!-- /form-group -->
                    <div class="col-12 col-lg-4 mb-3">
                      <label class="form-label required">Ngày kết thúc </label>
                      <validation-provider v-slot="{ errors }" rules="required">
                        <flat-pickr v-model="product.meta._timeline" :config="{ dateFormat: 'd/m/Y', minDate: 'today' }"
                          placeholder="dd/mm/yyyy" />
                        <span class="message">{{ errors[0] }}</span>
                      </validation-provider>
                    </div>
                    <div class="col-12 col-lg-4 mb-3">
                      <label class="form-label">Số lượng</label>
                      <input type="number" min="1" class="form-control" v-model.number="product.meta.memberNumber"
                        disabled />
                    </div>
                  </div>
                </div>
                <div class="form-group mb-3">
                  <label class="form-label required">
                    <span>Nội dung</span>
                  </label>
                  <validation-provider v-slot="{ errors }" rules="required">
                    <textarea class="form-control" rows="5" v-model="product.content" />
                    <span class="message">{{ errors[0] }}</span>
                  </validation-provider>
                </div>
                <div class="form-group">
                  <label class="form-label required">
                    <span> Mô tả</span>
                  </label>
                  <validation-provider v-slot="{ errors }" rules="required">
                    <textarea class="form-control" rows="5" v-model="product.description" />
                    <span class="message">{{ errors[0] }}</span>
                  </validation-provider>
                </div>
              </div>
              <!-- /col-lg-8 -->
              <div class="col-lg-4">
                <aside class="aside">
                  <div class="form-group mb-3">
                    <div class="form-label required">Cấp bậc</div>
                    <validation-provider v-slot="{ errors }" rules="required">
                      <select class="form-select" v-model="product.meta._rank">
                        <template v-for="rank in options.rank">
                          <option :key="rank" :value="rank.id">
                            {{ rank.name }}
                          </option>
                        </template>
                      </select>
                      <span class="message">{{ errors[0] }}</span>
                    </validation-provider>
                  </div>
                  <div class="form-group mb-3">
                    <div class="form-label required">Trình độ học vấn</div>
                    <validation-provider v-slot="{ errors }" rules="required">
                      <select class="form-select" v-model="product.meta._education_Level">
                        <template v-for="education in options.education">
                          <option :key="education" :value="education.id">
                            {{ education.name }}
                          </option>
                        </template>
                      </select>
                      <span class="message">{{ errors[0] }}</span>
                    </validation-provider>
                  </div>
                  <div class="form-group mb-3">
                    <label class="form-label">Loại hình làm việc</label>
                    <select class="form-select" v-model="product.meta._type_work">
                      <template v-for="work in options.work">
                        <option :key="work" :value="work.id">
                          {{ work.name }}
                        </option>
                      </template>
                    </select>
                  </div>
                  <div class="form-group mb-3">
                    <label class="form-label required">Kỹ năng yêu cầu</label>
                    <validation-provider v-slot="{ errors }" rules="required">
                      <select class="form-select" v-model="product.meta._skill">
                        <template v-for="skill in options.skill">
                          <option :key="skill" :value="skill.id">
                            {{ skill.name }}
                          </option>
                        </template>
                      </select>
                      <span class="message">{{ errors[0] }}</span>
                    </validation-provider>
                  </div>
                </aside>
              </div>
            </div>
          </section>
        </div>
      </div>
    </validation-observer>
  </section>
</template>

<script>
import { mapState } from 'vuex'
import { LOCATION } from '@/constants/common'
import { EDUCATION, EXP, RANK, SKILL, WORK } from '../../../constants/common'
export default {
  name: 'AdminAreaProductAdd',
  layout: 'admin.root',
  data: () => ({
    product: {
      meta: {
        _dateline: '',
        _timeline: '',
        memberNumber: 1,
        _address: '',
        _skill: '',
        _number_Level: '',
        _rank: '',
        _education_Level: '',
        _type_work: '120',
      },
    },
    options: {
      location: LOCATION,
      exp: EXP,
      skill: SKILL,
      education: EDUCATION,
      rank: RANK,
      work: WORK,
    },

  }),

  methods: {
    async onSubmit(valid) {
      if (!valid) {
        return;
      }
      try {
        this.product.user_id = this.$cookies.get('_user').id;
        let data = (await this.$store.dispatch('product/createProduct', this.product)).data;
        this.$router.push({ path: `/admin/product/checkadd`, query: { id: data.id } });

      } catch (error) {
        this.errors = this.$mixError(error);
      }
    },
    titleToSlug() {
      this.product.slug = this.toSlug(this.product.title);
    },
    toSlug(str, options = { replacement: '-' }) {
      if (!str) {
        console.error('String is empty');
        return '';
      }
      // eslint-disable-next-line
      const charMap = JSON.parse('{"$":"dollar","%":"percent","&":"and","<":"less",">":"greater","|":"or","¢":"cent","£":"pound","¤":"currency","¥":"yen","©":"(c)","ª":"a","®":"(r)","º":"o","À":"A","Á":"A","Â":"A","Ã":"A","Ä":"A","Å":"A","Æ":"AE","Ç":"C","È":"E","É":"E","Ê":"E","Ë":"E","Ì":"I","Í":"I","Î":"I","Ï":"I","Ð":"D","Ñ":"N","Ò":"O","Ó":"O","Ô":"O","Õ":"O","Ö":"O","Ø":"O","Ù":"U","Ú":"U","Û":"U","Ü":"U","Ý":"Y","Þ":"TH","ß":"ss","à":"a","á":"a","â":"a","ã":"a","ä":"a","å":"a","æ":"ae","ç":"c","è":"e","é":"e","ê":"e","ë":"e","ì":"i","í":"i","î":"i","ï":"i","ð":"d","ñ":"n","ò":"o","ó":"o","ô":"o","õ":"o","ö":"o","ø":"o","ù":"u","ú":"u","û":"u","ü":"u","ý":"y","þ":"th","ÿ":"y","Ā":"A","ā":"a","Ă":"A","ă":"a","Ą":"A","ą":"a","Ć":"C","ć":"c","Č":"C","č":"c","Ď":"D","ď":"d","Đ":"D","đ":"d","Ē":"E","ē":"e","Ė":"E","ė":"e","Ę":"e","ę":"e","Ě":"E","ě":"e","Ğ":"G","ğ":"g","Ģ":"G","ģ":"g","Ĩ":"I","ĩ":"i","Ī":"i","ī":"i","Į":"I","į":"i","İ":"I","ı":"i","Ķ":"k","ķ":"k","Ļ":"L","ļ":"l","Ľ":"L","ľ":"l","Ł":"L","ł":"l","Ń":"N","ń":"n","Ņ":"N","ņ":"n","Ň":"N","ň":"n","Ō":"O","ō":"o","Ő":"O","ő":"o","Œ":"OE","œ":"oe","Ŕ":"R","ŕ":"r","Ř":"R","ř":"r","Ś":"S","ś":"s","Ş":"S","ş":"s","Š":"S","š":"s","Ţ":"T","ţ":"t","Ť":"T","ť":"t","Ũ":"U","ũ":"u","Ū":"u","ū":"u","Ů":"U","ů":"u","Ű":"U","ű":"u","Ų":"U","ų":"u","Ŵ":"W","ŵ":"w","Ŷ":"Y","ŷ":"y","Ÿ":"Y","Ź":"Z","ź":"z","Ż":"Z","ż":"z","Ž":"Z","ž":"z","ƒ":"f","Ơ":"O","ơ":"o","Ư":"U","ư":"u","ǈ":"LJ","ǉ":"lj","ǋ":"NJ","ǌ":"nj","Ș":"S","ș":"s","Ț":"T","ț":"t","˚":"o","Ά":"A","Έ":"E","Ή":"H","Ί":"I","Ό":"O","Ύ":"Y","Ώ":"W","ΐ":"i","Α":"A","Β":"B","Γ":"G","Δ":"D","Ε":"E","Ζ":"Z","Η":"H","Θ":"8","Ι":"I","Κ":"K","Λ":"L","Μ":"M","Ν":"N","Ξ":"3","Ο":"O","Π":"P","Ρ":"R","Σ":"S","Τ":"T","Υ":"Y","Φ":"F","Χ":"X","Ψ":"PS","Ω":"W","Ϊ":"I","Ϋ":"Y","ά":"a","έ":"e","ή":"h","ί":"i","ΰ":"y","α":"a","β":"b","γ":"g","δ":"d","ε":"e","ζ":"z","η":"h","θ":"8","ι":"i","κ":"k","λ":"l","μ":"m","ν":"n","ξ":"3","ο":"o","π":"p","ρ":"r","ς":"s","σ":"s","τ":"t","υ":"y","φ":"f","χ":"x","ψ":"ps","ω":"w","ϊ":"i","ϋ":"y","ό":"o","ύ":"y","ώ":"w","Ё":"Yo","Ђ":"DJ","Є":"Ye","І":"I","Ї":"Yi","Ј":"J","Љ":"LJ","Њ":"NJ","Ћ":"C","Џ":"DZ","А":"A","Б":"B","В":"V","Г":"G","Д":"D","Е":"E","Ж":"Zh","З":"Z","И":"I","Й":"J","К":"K","Л":"L","М":"M","Н":"N","О":"O","П":"P","Р":"R","С":"S","Т":"T","У":"U","Ф":"F","Х":"H","Ц":"C","Ч":"Ch","Ш":"Sh","Щ":"Sh","Ъ":"U","Ы":"Y","Ь":"","Э":"E","Ю":"Yu","Я":"Ya","а":"a","б":"b","в":"v","г":"g","д":"d","е":"e","ж":"zh","з":"z","и":"i","й":"j","к":"k","л":"l","м":"m","н":"n","о":"o","п":"p","р":"r","с":"s","т":"t","у":"u","ф":"f","х":"h","ц":"c","ч":"ch","ш":"sh","щ":"sh","ъ":"u","ы":"y","ь":"","э":"e","ю":"yu","я":"ya","ё":"yo","ђ":"dj","є":"ye","і":"i","ї":"yi","ј":"j","љ":"lj","њ":"nj","ћ":"c","ѝ":"u","џ":"dz","Ґ":"G","ґ":"g","Ғ":"GH","ғ":"gh","Қ":"KH","қ":"kh","Ң":"NG","ң":"ng","Ү":"UE","ү":"ue","Ұ":"U","ұ":"u","Һ":"H","һ":"h","Ә":"AE","ә":"ae","Ө":"OE","ө":"oe","฿":"baht","ა":"a","ბ":"b","გ":"g","დ":"d","ე":"e","ვ":"v","ზ":"z","თ":"t","ი":"i","კ":"k","ლ":"l","მ":"m","ნ":"n","ო":"o","პ":"p","ჟ":"zh","რ":"r","ს":"s","ტ":"t","უ":"u","ფ":"f","ქ":"k","ღ":"gh","ყ":"q","შ":"sh","ჩ":"ch","ც":"ts","ძ":"dz","წ":"ts","ჭ":"ch","ხ":"kh","ჯ":"j","ჰ":"h","Ẁ":"W","ẁ":"w","Ẃ":"W","ẃ":"w","Ẅ":"W","ẅ":"w","ẞ":"SS","Ạ":"A","ạ":"a","Ả":"A","ả":"a","Ấ":"A","ấ":"a","Ầ":"A","ầ":"a","Ẩ":"A","ẩ":"a","Ẫ":"A","ẫ":"a","Ậ":"A","ậ":"a","Ắ":"A","ắ":"a","Ằ":"A","ằ":"a","Ẳ":"A","ẳ":"a","Ẵ":"A","ẵ":"a","Ặ":"A","ặ":"a","Ẹ":"E","ẹ":"e","Ẻ":"E","ẻ":"e","Ẽ":"E","ẽ":"e","Ế":"E","ế":"e","Ề":"E","ề":"e","Ể":"E","ể":"e","Ễ":"E","ễ":"e","Ệ":"E","ệ":"e","Ỉ":"I","ỉ":"i","Ị":"I","ị":"i","Ọ":"O","ọ":"o","Ỏ":"O","ỏ":"o","Ố":"O","ố":"o","Ồ":"O","ồ":"o","Ổ":"O","ổ":"o","Ỗ":"O","ỗ":"o","Ộ":"O","ộ":"o","Ớ":"O","ớ":"o","Ờ":"O","ờ":"o","Ở":"O","ở":"o","Ỡ":"O","ỡ":"o","Ợ":"O","ợ":"o","Ụ":"U","ụ":"u","Ủ":"U","ủ":"u","Ứ":"U","ứ":"u","Ừ":"U","ừ":"u","Ử":"U","ử":"u","Ữ":"U","ữ":"u","Ự":"U","ự":"u","Ỳ":"Y","ỳ":"y","Ỵ":"Y","ỵ":"y","Ỷ":"Y","ỷ":"y","Ỹ":"Y","ỹ":"y","‘":"\'","’":"\'","“":"\\"","”":"\\"","†":"+","•":"","…":"...","₠":"ecu","₢":"cruzeiro","₣":"french franc","₤":"lira","₥":"mill","₦":"naira","₧":"peseta","₨":"rupee","₩":"won","₪":"new shequel","₫":"dong","€":"euro","₭":"kip","₮":"tugrik","₯":"drachma","₰":"penny","₱":"peso","₲":"guarani","₳":"austral","₴":"hryvnia","₵":"cedi","₸":"kazakhstani tenge","₹":"indian rupee","₺":"turkish lira","₽":"russian ruble","₿":"bitcoin","℠":"sm","™":"tm","∂":"d","∆":"delta","∑":"sum","∞":"infinity","♥":"love","元":"yuan","円":"yen","﷼":"rial"}');
      const locales = JSON.parse('{"de":{"Ä":"AE","ä":"ae","Ö":"OE","ö":"oe","Ü":"UE","ü":"ue"},"vi":{"Đ":"D","đ":"d"}}'); if (typeof str !== 'string') {
        throw new TypeError('slugify: string argument expected');
      } options = (typeof options === 'string')
        ? { replacement: options }
        : options || {}; const locale = locales[options.locale] || {}; const replacement = options.replacement === undefined ? '-' : options.replacement; let slug = str.split('')
          // replace characters based on charMap
          .reduce(function (result, ch) {
            return result + (locale[ch] || charMap[ch] || ch)
              // remove not allowed characters
              .replace(options.remove || /[^\w\s$*_+~.()'"!\-:@]+/g, '');
          }, '')
          // trim leading/trailing spaces
          .trim()
          // convert spaces to replacement character
          // also remove duplicates of the replacement character
          .replace(new RegExp('[\\s' + replacement + ']+', 'g'), replacement); if (options.lower) {
            slug = slug.toLowerCase();
          } if (options.strict) {
            // remove anything besides letters, numbers, and the replacement char
            slug = slug
              .replace(new RegExp('[^a-zA-Z0-9' + replacement + ']', 'g'), '')
              // remove duplicates of the replacement character
              .replace(new RegExp('[\\s' + replacement + ']+', 'g'), replacement);
          } return slug.toLowerCase();
    },

  },
}
</script>

<style scoped lang="scss">
.message {
  color: red;
}

.step {
  display: flex;
  list-style: none;
  margin: 0;
  padding: 0;
  align-items: center;

  span {
    margin: 5px 25px;
    display: inline-block;
  }

  li {
    position: relative;
    width: 180px;

    &:before {
      content: attr(title);
      background: #fff;
      border: 1px solid #ff6116;
      border-radius: 5px;
      color: #ff6116;
      display: block;
      margin: 0 35px;
      text-align: center;
      width: 35px;
      height: 35px;
      line-height: 35px;
      font-size: 0.8rem;
      letter-spacing: 1px;
      font-weight: 500;
      position: relative;
      z-index: 1;
    }

    &:after {
      content: '';
      height: 3px;
      left: 35px;
      position: absolute;
      top: 15px;
      width: 100%;
      z-index: 0;
      border-bottom: 1px dashed #ddd;
    }
  }

  li:last-child {
    &:after {
      border-bottom: none;
    }
  }

  .active {
    &:before {
      background: #ff6116;
      color: #fff;
    }
  }
}

.aside {
  background-color: #f7f6f6;
  padding: 1em;
  border-radius: 10px;
}

.card-control {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1em;
}

.flatpickr-input {
  display: block;
  width: 100%;
  padding: 0.4375rem 0.75rem;
  font-size: 0.875rem;
  font-weight: 400;
  line-height: 1.4285714286;
  color: inherit;
  background-color: #ffffff;
  background-clip: padding-box;
  border: 1px solid #d9dbde;
  appearance: none;
  border-radius: 4px;
}

.btn-post {
  padding: 0.4em 3em;
  border: 2px solid #ff6116;
  background: #ff6116;
  color: #fff;
  border-radius: 20px;
}

.btn-request {
  display: inline-flex;
  margin-top: 0.5em;
  font-weight: 100;
  font-size: 0.8rem;
  flex-direction: column;
  align-items: center;

  label {
    margin-top: 0.5em;
    display: flex;
    align-items: center;
    gap: 5px;
  }
}
</style>
