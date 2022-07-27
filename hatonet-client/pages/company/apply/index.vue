<template>
    <div class="mt-3 mb-3 ">
        <h4 class="title">{{ jobDetail.product.user.name }}</h4>
        <div class="container">
            <div class="content">
                <h4 class="title ">{{ jobDetail.product.title }}</h4>
                <div class="content__title">
                    <div class="description">
                        <div class="column mb-3">
                            <div class="fixed_boder">Hạn ứng tuyển :
                                {{
                                        jobDetail.meta._dateline
                                }}
                            </div>
                            <div class="fixed_boder">Kỹ năng yêu cầu :
                                {{
                                        jobDetail.meta._skill
                                }}
                            </div>
                            <div class="fixed_boder">Số năm kinh nghiệm :
                                {{
                                        jobDetail.meta._number_Level
                                }}
                            </div>
                            <div class="fixed_boder">
                                Giá tiền :
                                {{
                                        new Intl.NumberFormat().format(jobDetail.product.price_sale)
                                }} VND
                            </div>
                        </div>
                        <span>Mô tả:</span>
                        <p>
                            {{ jobDetail.product.description }}
                        </p>
                        <span>Nội dung:</span>
                        <p>
                            {{ jobDetail.product.content }}
                        </p>
                    </div>
                </div>
                <div class="participating mt-6">
                    <div @click="openInterviewModal" class="boder mb-3">
                        <h5 class="mt-3"> Còn trống</h5>
                        <span class="ti ti-files icon"></span>
                    </div>
                    <div @click="openInterviewModal" class="boder mb-3">
                        <h5 class="mt-3"> Còn trống</h5>
                        <span class="ti ti-files icon"></span>
                    </div>
                    <div @click="openInterviewModal" class="boder">
                        <h5 class="mt-3"> Còn trống</h5>
                        <span class="ti ti-files icon"></span>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="content__title">
                    <div class="column">
                        <div class="title">
                            <div class="slot">Ứng viên 1</div>
                            <input type="checkbox"> Chọn
                        </div>
                        <div class="title">
                            <div class="slot">Ứng viên 2</div>
                            <input type="checkbox"> Chọn
                        </div>
                        <div class="title">
                            <div class="slot">Ứng viên 3</div>
                            <input type="checkbox"> Chọn
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="interviewModalVisible" class="vodal-container">
            <div class="vodal-mask">
                <div class="vodal">
                    <header>
                        <div @click.prevent="closeModal" class="ti ti-x close mb-3"></div>
                        <div class="mb-3">
                            {{ dataParams.idUser.name }}
                        </div>
                    </header>
                    <div class="body_company">
                        <div class="plus_one">

                            <div class="body_company">
                                <div class="body_company_info">
                                    <div class="boder_none  mb-3 mt-3">
                                        <h6 class="mt-2"> Ảnh chân dung</h6>
                                        <input type='file' id="imageUpload" class="upload" accept=".png, .jpg, .jpeg"
                                            @change="uploadImage($event)" />
                                        <span class="ti ti-camera icon_camera"></span>
                                    </div>
                                    <div class="button_pdf">
                                        <button class="btn ">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
                                                <path
                                                    d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                                <path
                                                    d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z" />
                                            </svg>
                                            <span>Tải CV</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="body_company_info">
                                    <div class="mt-3 body_company">
                                        <span class="body_company_input"> Họ và Tên</span>
                                        <span class="body_company_info">
                                            <input type="text" class="form-control" v-model="apply.name">
                                        </span>
                                    </div>
                                    <div class="mt-3 body_company">
                                        <span class="body_company_input"> Ngày sinh</span>
                                        <span class="body_company_info">
                                            <flat-pickr v-model="apply.birthday" class="form-control"
                                                :config="{ dateFormat: 'd/m/Y' }" placeholder="dd/mm/yyyy" />
                                        </span>
                                    </div>
                                    <div class="mt-3 body_company">
                                        <span class="body_company_input"> Kĩ năng</span>
                                        <span class="body_company_info">
                                            <select class="form-control" v-model="apply.skill">
                                                <template v-for="skill in options.skill">
                                                    <option :value="skill.id">
                                                        {{ skill.name }}
                                                    </option>
                                                </template>
                                            </select>
                                        </span>
                                    </div>
                                    <div class="mt-3 body_company">
                                        <span class="body_company_input">Kinh nghiệm</span>
                                        <span class="body_company_info">
                                            <select class="form-control" v-model="apply.level">
                                                <template v-for="exp in options.exp">
                                                    <option :value="exp.id">
                                                        {{ exp.name }}
                                                    </option>
                                                </template>
                                            </select>
                                        </span>
                                    </div>
                                    <div class="mt-3 body_company">
                                        <span class="body_company_input">Giá thuê</span>
                                        <span class="body_company_info">
                                            <input type="" min="1" class="form-control" v-model="apply.rental_prices"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="title mt-3">
                                <button class="button_T" @click="applyCV">Gửi CV</button>
                            </div>
                        </div>
                        <div class="plus">
                            <button class=" btn button_join">
                                <h6 class=" mt-3">Thêm CV</h6>
                                <span class="ti ti-square-plus icon_noe"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { EXP, SKILL } from '@/constants/common'

export default {
    data: function () {
        return {
            apply: [],
            interviewModalVisible: false,
            options: {
                skill: SKILL,
                exp: EXP,
            }
        }

    },
    asyncData: async ({ $axios, $cookies, error, query }) => {
        try {
            let dataParams = {
                idProduct: query.id,
                idUser: $cookies.get('_user') || {}
            }
            const { data: jobDetail } = await $axios.get(`/api/jobs/${dataParams.idProduct}`)
            return { jobDetail, dataParams }
        } catch (e) {
            error({
                statusCode: 404, message: ''
            });
        }
    },
    methods: {
        closeModal() {
            this.interviewModalVisible = false;
        },
        openInterviewModal() {
            this.interviewModalVisible = true;
        },

        uploadImage(e) {
            this.apply.avatar = e.target.files[0]
        },

        async applyCV() {
            try {
                console.log(this.apply);
                await this.$store.dispatch('apply/createApply', this.apply)

            } catch (error) {

            }
        }
    }

}
</script>
<style scoped lang="scss">
.body_company_info {
    width: 350px;
    ;
}

.icon_noe {
    font-size: 30px;
}

.icon_camera {
    position: relative;
    font-size: 30px;
}

.button_T {
    padding: 0.3em 0.6em;
    border-radius: 5px;
    border: none;
    background: #ea530a;
    color: #fff;
    margin-left: 1em;
    font-weight: 600;
    border: 2px solid #ea530a;
}

.button_join {
    background-color: #f7f6f6;
    margin-bottom: 130px;
    margin-top: 130px;
    border-radius: 60px !important;
    text-align: center;
    border-style: dashed !important;


}

.upload {
    position: absolute;
    margin-left: -61px;
    width: 150px;
    height: 150px;
    margin-top: -77px;
    opacity: 0;


}

.btn {
    display: inline-block;
    font-weight: 500;
    line-height: 1.4285714286;
    color: #1e293b;
    text-align: center;
    vertical-align: middle;
    user-select: none;
    border: 2px solid #455a64;
    padding: 0.4375rem 1rem;
    font-size: 0.875rem;
    border-radius: 4px;
}

.body_company_input {
    width: 200px
}

.btn-pdf {
    font-size: 0.8rem;

    svg {
        width: 20px;
        height: 20px;
        margin-right: 0.3em;
    }
}

.form-control {
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
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.body_company {
    display: flex;
    width: 100%;

}

.fixed_boder {
    justify-content: center;
    width: 100%;

}

.participating {
    justify-content: center;
    width: 100%;
    display: flex;
}

.vodal-mask {
    z-index: 10;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.35);
}

.vodal {
    position: absolute;
    background: #f8f8f8;
    z-index: 9999;
    width: 750px;
    height: 500px;
    top: 90px;
    left: 412px;
    right: 412px;
    border-radius: 10px;
    padding: 1em;
}

.column {
    display: flex;
}

.icon {
    font-size: 40px;
}

.boder {
    background-color: #f7f6f6;
    padding: 1em;
    border-style: dashed;
    margin-left: 100px;
    margin-right: 100px;
    justify-content: center;
    border-radius: 10px;
    height: 140px;
    width: 140px;
    text-align: center;
}

.boder_none {
    background-color: #f7f6f6;
    padding: 1em;
    border-style: dashed;
    justify-content: center;
    margin-left: auto;
    margin-right: auto;
    border-radius: 10px;
    height: 140px;
    width: 140px;
    text-align: center;
}

.button_pdf {
    background-color: #f7f6f6;
    padding: 1em;
    margin-left: auto;
    margin-right: auto;
    justify-content: center;
    border-radius: 10px;
    width: 140px;
    text-align: center;
    border-radius: 10px;
}

.container {
    width: 100%;
    padding-right: 0.75rem;
    padding-left: 0.75rem;
    margin-right: auto;
    margin-left: auto;
}

.title {
    text-align: center;

}

.description {
    width: 100%;
    padding: 15px;
    border-radius: 10px;
    background: #f7f6f6;
    box-shadow: 0.4px 0.4px 24px rgb(0 0 0 / 8%);
}

.slot {
    padding: 15px;
    border-radius: 10px;
    background: #f7f6f6;
    flex: auto;
}

.plus_one {
    width: 80%;
    padding: 15px;
    border-radius: 10px;
    background: #f7f6f6;
    box-shadow: 0.3px 0.3px 24px rgb(0 0 0 / 8%);
}

.plus {
    margin-left: 15px;
    width: 20%;
    background: #f8f8f8;
}

.content {
    background-color: #fff;
    padding: 2em;
    border-radius: 20px;
    margin-bottom: 2em;

    &__title {
        margin-bottom: 1em;

        h1 {
            font-size: 1.3rem;
            font-weight: 600;
        }
    }
}
</style>