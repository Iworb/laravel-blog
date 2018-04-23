<template>
    <q-page>
        <h1>Articles</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>title</th>
                <th>slug</th>
                <th>user</th>
            </tr>
            <tbody>
            <tr v-for="article in articles">
                <td>{{ article.id }}</td>
                <td>{{ article.title }}</td>
                <td>{{ article.slug }}</td>
                <td>{{ article.user }}</td>
            </tr>
            </tbody>
        </table>

        <div class="pagination">
            <button :disabled="! prevPage" @click.prevent="goToPrev">Previous</button>
            {{ paginatonCount }}
            <button :disabled="! nextPage" @click.prevent="goToNext">Next</button>
        </div>
    </q-page>
</template>
<script>
  import axios from 'axios'

  const getArticles = async params => {
    return (await axios.get('/api/articles', {params})).data
  }

  export default {
    data() {
      return {
        articles: [],
        meta: null,
        links: {
          first: null,
          last: null,
          next: null,
          prev: null,
        },
        error: null,
      }
    },
    computed: {
      nextPage() {
        if (!this.meta || this.meta.current_page === this.meta.last_page) {
          return
        }
        return this.meta.current_page + 1
      },
      prevPage() {
        if (!this.meta || this.meta.current_page === 1) {
          return
        }
        return this.meta.current_page - 1
      },
      paginatonCount() {
        if (!this.meta) {
          return
        }
        const {current_page, last_page} = this.meta
        return `${current_page} of ${last_page}`
      },
    },
    async beforeRouteEnter(to, from, next) {
      const data = await getArticles(to.query)
      next(vm => vm.setData(data))
    },
    async beforeRouteUpdate(to, from, next) {
      this.users = this.links = this.meta = null
      const data = await getArticles(to.query)
      this.setData(data)
      next()
    },
    methods: {
      goToNext() {
        this.$router.push({
          query: Object.assign({}, this.$route.query, {page: this.nextPage})
        })
      },
      goToPrev() {
        this.$router.push({
          query: Object.assign({}, this.$route.query, {page: this.prevPage})
        })
      },
      setData({data: articles, links, meta}) {
        this.articles = articles
        this.links = links
        this.meta = meta
      },
    }
  }
</script>