<template>
    <div>
        <h1>Articles</h1>

        <div class="row">
            <div class="col-md-10"></div>
            <div class="col-md-2">
                <router-link :to="{ name: 'ArticleCreate' }" class="btn btn-primary">Create Article</router-link>
            </div>
        </div>
        <br/>

        <table class="table table-hover">
            <thead>
            <tr>
                <td>ID</td>
                <td>Title</td>
                <td>Slug</td>
                <td>Description</td>
                <td>Body</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>
            <tr v-for="article in articles">
                <td>{{ article.id }}</td>
                <td>{{ article.title }}</td>
                <td>{{ article.slug }}</td>
                <td>{{ article.description }}</td>
                <td>{{ article.body }}</td>
                <td>
                    <router-link :to="{name: 'ArticleEdit', params: { id: article.id }}" class="btn btn-primary">Edit
                    </router-link>
                </td>
                <td>
                    <button class="btn btn-danger" v-on:click="deleteArticle(article.id)">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="pagination">
            <button :disabled="! prevPage" @click.prevent="goToPrev">Previous</button>
            {{ paginatonCount }}
            <button :disabled="! nextPage" @click.prevent="goToNext">Next</button>
        </div>
    </div>
</template>

<script>
  import axios from 'axios';

  const getArticles = async page => {
    const params = {page};
    return await axios.get('/api/articles', {params})
  };

  export default {
    data() {
      return {
        articles: null,
        meta: null,
        links: {
          first: null,
          last: null,
          next: null,
          prev: null,
        },
        error: null,
      };
    },
    computed: {
      nextPage() {
        if (!this.meta || this.meta.current_page === this.meta.last_page) {
          return;
        }

        return this.meta.current_page + 1;
      },
      prevPage() {
        if (!this.meta || this.meta.current_page === 1) {
          return;
        }

        return this.meta.current_page - 1;
      },
      paginatonCount() {
        if (!this.meta) {
          return;
        }

        const {current_page, last_page} = this.meta;

        return `${current_page} of ${last_page}`;
      },
    },
    async beforeRouteEnter(to, from, next) {
      const data = await getArticles(to.query.page)
      next(vm => vm.setData(data.data))
    },
    async beforeRouteUpdate(to, from, next) {
      this.articles = this.links = this.meta = null
      this.setData((await getArticles(to.query.page)).data)
      next()
    },
    methods: {
      goToNext() {
        this.$router.push({
          query: {
            page: this.nextPage,
          },
        });
      },
      goToPrev() {
        this.$router.push({
          query: {
            page: this.prevPage,
          }
        });
      },
      setData({data: articles, links, meta}) {
        this.articles = articles;
        this.links = links;
        this.meta = meta;
      },
    }
  }
</script>