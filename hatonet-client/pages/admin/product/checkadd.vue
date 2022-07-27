<template>
    <section>
        <div class="card mb-2">
            <div class="card-control">
                <ul class="step">
                    <li title="1">
                        <span>Thông tin</span>
                    </li>
                    <li class="active" title="2">
                        <span>Đăng tin</span>
                    </li>
                </ul>
                <div>
                    <div class="btn-request">
                        <nuxt-link :to="{ path: '/admin/product/edit', query: { id: detail.id } }" class="btn-post">Quay
                            lại</nuxt-link>
                    </div>
                    <div class="btn-request">
                        <nuxt-link :to="{ path: '/admin/product' }" class="btn-post">Đăng Tin Ngay</nuxt-link>
                        <label>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <section title="Thông tin" :selected="true">
                    <!-- /header -->
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="mb-3">
                                <div class="row">
                                    <div>
                                        <div class="mb-3">
                                            <label class="form-label">Tiêu đề</label>
                                            <div>{{ detail.title }}</div>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="form-label">Slug</label>
                                        <div>{{ detail.slug }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-12 col-lg-4 mb-3">
                                        <label class="form-label">Tỉnh / thành phố</label>
                                        <div v-for=" proMe in detail.product_meta" :key="proMe.id">
                                            <div v-if="proMe.meta_key == '_address'">
                                                <div v-for="location in options.location">
                                                    <span v-if="proMe.meta_value == location.id">
                                                        {{ location.name }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /form-group -->
                                    <div class="col-12 col-lg-4 mb-3">
                                        <div class="form-label">Kinh nghiệm</div>
                                        <div v-for=" proMe in detail.product_meta" :key="proMe.id">
                                            <div v-if="proMe.meta_key == '_number_Level'">
                                                <div v-for="exp in options.exp">
                                                    <span v-if="proMe.meta_value == exp.id">
                                                        {{ exp.name }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4 mb-3">
                                        <div class="form-label">Giá bán / Người / Tháng</div>
                                        <div>{{ new Intl.NumberFormat().format(detail.price_sale) }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label">Hạn ứng tuyển</label>
                                            <div>
                                                {{ detail.meta._dateline }}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /form-group -->
                                    <div class="col-12 col-lg-4">
                                        <label class="form-label">Ngày kết thúc</label>
                                        <div>
                                            {{ detail.meta._timeline }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4 mb-3">
                                        <label class="form-label">Số lượng</label>
                                        <div>{{ detail.qty }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">
                                    <span>Nội dung</span>
                                </label>
                                <div rows="5">{{ detail.content }}</div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">
                                    <span>Mô tả</span>
                                </label>
                                <div rows="5">{{ detail.description }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <aside class="aside">
                                <div class="form-group mb-3">
                                    <div class="form-label">Cấp bậc</div>
                                    <div v-for=" proMe in detail.product_meta" :key="proMe.id">
                                        <div v-if="proMe.meta_key == '_rank'">
                                            <div v-for="rank in options.rank">
                                                <span v-if="proMe.meta_value == rank.id">
                                                    {{ rank.name }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <div class="form-label">Trình độ học vấn</div>
                                    <div v-for=" proMe in detail.product_meta" :key="proMe.id">
                                        <div v-if="proMe.meta_key == '_education_Level'">
                                            <div v-for="education in options.education">
                                                <span v-if="proMe.meta_value == education.id">
                                                    {{ education.name }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Loại hình làm việc</label>
                                    <div v-for=" proMe in detail.product_meta" :key="proMe.id">
                                        <div v-if="proMe.meta_key == '_type_work'">
                                            <div v-for="work in options.work">
                                                <span v-if="proMe.meta_value == work.id">
                                                    {{ work.name }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Kỹ năng yêu cầu</label>
                                    <div v-for=" proMe in detail.product_meta" :key="proMe.id">
                                        <div v-if="proMe.meta_key == '_skill'">
                                            <div v-for="skill in options.skill">
                                                <span v-if="proMe.meta_value == skill.id">
                                                    {{ skill.name }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Trạng Thái</label>
                                    <div>
                                        <span>{{ detail.status }}</span>
                                    </div>
                                </div>
                            </aside>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</template>>

<script>
import { LOCATION } from '@/constants/common'
import { EDUCATION, EXP, RANK, SKILL, WORK } from '@/constants/common'
import { mapState } from 'vuex'
export default {
    name: 'AdminAreaProductAdd',
    layout: 'admin.root',
    data: () => ({
        product: {
            meta: {
            },
        },
        options: {
            location: LOCATION,
            exp: EXP,
            skill: SKILL,
            rank: RANK,
            education: EDUCATION,
            work: WORK,
        },
    }),

    computed: { ...mapState('product', ['detail']) },

    async fetch({ store, $cookies, route }) {
        this.auth = $cookies.get('_user')
        // id route
        const { id } = route.query;
        await store.dispatch('product/getProductId', id);
    },
}
</script>

<style scoped lang="scss">
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

.admin a:hover {
    color: #ffffff;
    text-decoration: none;
}
</style>
