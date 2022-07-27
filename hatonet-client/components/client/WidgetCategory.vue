<template>
  <div class="aside">
    <ul>
      <li v-for="category in categories" :key="category.id">
        <nuxt-link :to="{ path: `/posts/taxonomy`, query: { id: category.id } }" >
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder"
              viewBox="0 0 16 16">
              <path
                d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z" />
            </svg>
          </span>
          {{ category.title }}
        </nuxt-link>
        <span class="label">{{ category.post_count }}</span>
      </li>
      <div class="card-footer d-flex align-items-center">
        <paginate :total="categories.total" @paginate="paginate" />
      </div>
    </ul>
  </div>
</template>

<script>
import Paginate from '@/components/Paginate.vue'
export default {
   components: { Paginate },
  props:[
    "categories",
  ],
}
</script>

<style scoped lang="scss">
.aside {
  background-color: #fff;
  border-radius: 20px;
  padding: 1em 1.5em;
  margin-bottom: 2em;

  ul {
    padding: 0;
    list-style: none;
    margin: 1em 0;

    li {
      padding: 0.6em 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px dashed #ddd;

      .label {
        height: 20px;
        width: 20px;
        font-size: 0.8rem;
        line-height: 20px;
        background: #dddddd;
        text-align: center;
        border-radius: 50%;
        color: #455a64;
      }

      a {
        text-decoration: none;
        font-size: 1rem;
        color: #455a64;
        font-size: 500;
      }

      svg {
        fill: #ddd;
        position: relative;
        top: -3px;
        width: 20px;
        height: 20px;
      }

      &:last-child {
        border-bottom: none;
      }
    }
  }

  img {
    width: 100%;
    border-radius: 20px;
  }

  &--no {
    padding: 0;
  }
}
</style>