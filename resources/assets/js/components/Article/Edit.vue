<template>
    <div>
        <h1>Update Article</h1>
        <div class="row">
            <div class="col-md-10"></div>
            <div class="col-md-2">
                <router-link :to="{ name: 'ArticleList' }" class="btn btn-success">Return to Articles</router-link>
            </div>
        </div>

        <form v-on:submit.prevent="updateArticle">
            <div class="form-group">
                <label>Title:</label>
                <input type="text" class="form-control" v-model="article.title">
            </div>

            <div class="form-group">
                <label>Slug:</label>
                <input type="text" class="form-control" v-model="article.slug">
            </div>

            <div class="form-group">
                <label>Description:</label>
                <textarea class="form-control" v-model="article.description"></textarea>
            </div>

            <div class="form-group">
                <label>Body:</label>
                <textarea class="form-control" v-model="article.body"></textarea>
            </div>

            <div class="form-group">
                <button class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</template>

<script>

  export default {
    data() {
      return {
        article: {}
      }
    },

    async created() {
      await this.getArticle()
    },

    methods: {
      async getArticle() {
        this.article = (await this.axios.get(`/api/articles/${this.$route.params.id}/edit`)).data
      },
      async updateArticle() {
        await this.axios.patch(`/api/articles/${this.$route.params.id}`, this.article)
        this.$router.push({name: 'ArticleList'});
      }
    }
  }
</script>