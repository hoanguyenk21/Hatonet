<template>
  <div class="block">
    <div class="container">
      <h2 class="block__title">Tìm kiếm cơ hội nhận thưởng</h2>
      <div class="search">
        <div class="search__input">
          <input
            type="text"
            placeholder="Nhập từ khóa tìm kiếm..."
            :value="valueSearch"
            @input="handleChangInput"
          />
          <div class="extension">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="16"
              height="16"
              fill="currentColor"
              class="bi bi-search"
              viewBox="0 0 16 16"
            >
              <path
                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"
              />
            </svg>
          </div>
          <div v-show="valueSearch" @click="removeValue(1)"><i class="ti ti-x"></i></div>
        </div>
        <div class="search__skill">
          <select class="scrollbar" @change="selectProvince">
            <option value="" :selected="valueProvince == ''">Thành Phố</option>
            <option
              v-for="(item, index) in location"
              :key="index"
              :value="item.id"
            >
              {{ item.name }}
            </option>
          </select>
          <div class="extension">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="16"
              height="16"
              fill="currentColor"
              class="bi bi-geo-alt"
              viewBox="0 0 16 16"
            >
              <path
                d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"
              />
              <path
                d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"
              />
            </svg>
          </div>
          <i class="ti ti-x" v-show="valueProvince" @click="removeValue(2)"></i>
        </div>
        <div class="search__locations">
          <select class="scrollbar" @change="selectSkill">
            <option value="" :selected="valueSkill == ''">Kỹ Năng</option>
            <option
              v-for="(item, index) in skill"
              :key="index"
              :value="item.id"
            >
              {{ item.name }}
            </option>
          </select>
          <i class="ti ti-x" v-show="valueSkill" @click="removeValue(3)"></i>
          <div class="extension">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="16"
              height="16"
              fill="currentColor"
              class="bi bi-briefcase"
              viewBox="0 0 16 16"
            >
              <path
                d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z"
              />
            </svg>
          </div>
        </div>
        <button @click="clickSearch" class="btn-search">Tìm kiếm</button>
      </div>
      <div class="block__keywork">
        <span>Gợi ý từ khóa :</span>
        <ul class="tags">
          <li v-for="(tag, index) in tags" :key="index" @click="searchTag(tag)">
            {{ tag }}
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import { LOCATION, SKILL } from '@/constants/common'
import { baseUrl } from '@/env/env.development'

export default {
  name: 'SectionSearch',
  props: ['valueSearch', 'valueProvince', 'valueSkill'],
  data() {
    return {
      location: LOCATION,
      skill: SKILL,
      tags: ['Javascript', 'VueJS', 'Angular', 'Java', 'ReactJS'],
    }
  },

  methods: {
    handleChangInput(e) {
      this.$emit('input', e.target.value)
    },

    selectProvince(e) {
      this.$emit('changeProvince', e.target.value)
    },

    selectSkill(e) {
      this.$emit('changeSkill', e.target.value)
    },

    searchTag(tag) {
      if (this.valueSearch.includes(tag)) return
      const result = tag
      this.$emit('input', result)
    },

    clickSearch(){
      this.$emit('handleSearch')
    },
    removeValue(value){
      this.$emit('removeValue', value)
    }
  },
}
</script>

<style scoped lang="scss">
.block {
  padding: 3em 0;
  background: linear-gradient(359deg, #ffffff, #fbefeb) no-repeat 0 20%;
  label {
    display: inline-block;
  }

  &__title {
    font-size: 1.8rem;
    font-weight: 800;
    color: #455964;
    margin-bottom: 0.5em;
  }

  &__keywork {
    padding: 1em 0;
    display: flex;
    gap: 15px;
    span {
      font-size: 1rem;
      line-height: 1.9rem;
      font-weight: 300;
      color: #455964;
      text-align: center;
    }
  }
  select {
    width: 100%;
    height: 50px;
    padding: 0 2em;
    border: 1px solid #fff;
  }
  input {
    width: 100%;
    height: 50px;
    padding: 0 3em;
    border-top-left-radius: 8px;
    border-bottom-left-radius: 8px;
    border: 1px solid #fff;
    &:focus {
      outline: none;
    }
  }
  .btn-search {
    width: 200px;
    background: #f60;
    border: 1px solid #f60;
    font-size: 1rem;
    font-weight: 500;
    height: 50px;
    color: #fff;
    border-top-right-radius: 8px;
    border-bottom-right-radius: 8px;
    &:hover{
      color: #1675a1;
    }
  }

}
.tags {
  margin: 0;
  padding: 0;
  list-style: none;
  display: flex;
  gap: 0.5em;
  flex-wrap: wrap;
  li {
    background: #455964;
    color: #fff;
    display: inline-block;
    padding: 0 1.4em;
    font-size: 0.8rem;
    height: 25px;
    line-height: 25px;
    border-radius: 30px;
    font-weight: 600;
    cursor: pointer;
  }
}
.search {
  display: flex;
  align-items: center;
  box-sizing: border-box;
  border-radius: 10px;
  box-shadow: 2px 4px 12px rgb(0 0 0 / 8%);
  margin-bottom: 0.5em;
  &__input {
    flex: 3;
    position: relative;
    div:last-child{
      position: absolute;
      right: 3%;
      bottom: 45%;
      transform: translateY(50%);
      font-size: 20px;
      color: lightgrey;
      cursor: pointer;
    }
  }

  &__skill {
    width: 250px;
    padding: 0 1em;
    background: #fff;
    border-left: 1px solid #f1f1f1;
    position: relative;
  }

  &__locations {
    width: 250px;
    padding: 0 1em;
    background: #fff;
    border-left: 1px solid #f1f1f1;
    position: relative;
  }

  &__skill i, &__locations i{
      position: absolute;
      right: 12%;
      bottom: 50%;
      transform: translateY(50%);
      font-size: 20px;
      color: lightgray;
      cursor: pointer;
  }

  .extension {
    position: absolute;
    top: 13px;
    left: 1em;
    svg {
      width: 22px;
      height: 22px;
      fill: #9b9b9b;
    }
  }
}

.scrollbar {
  float: left;
  height: 300px;
  width: 65px;
  overflow-y: scroll;
  margin-left: 1px;
  outline: none;
}
.scrollbar::-webkit-scrollbar-track {
  -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
  background-color: #f5f5f5;
}

.scrollbar::-webkit-scrollbar {
  width: 10px;
  background-color: #f5f5f5;
}

.scrollbar::-webkit-scrollbar-thumb {
  background-color: #f90;
  background-image: -webkit-linear-gradient(
    45deg,
    rgba(255, 255, 255, 0.2) 25%,
    transparent 25%,
    transparent 50%,
    rgba(255, 255, 255, 0.2) 50%,
    rgba(255, 255, 255, 0.2) 75%,
    transparent 75%,
    transparent
  );
}
</style>
