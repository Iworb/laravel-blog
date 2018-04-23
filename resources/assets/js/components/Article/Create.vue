<template>
    <div>
        <h1>Create An Article</h1>
        <form v-on:submit.prevent="addArticle">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Title:</label>
                        <input type="text" class="form-control" v-model="article.title">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Slug:</label>
                        <input type="text" class="form-control" v-model="article.slug">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Description:</label>
                        <textarea class="form-control" v-model="article.description"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Body:</label>
                        <textarea class="form-control" v-model="article.body"></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Add Article</button>
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
    methods: {
      async addArticle() {
        await this.axios.post('/api/articles', this.article)
        this.$router.push({name: 'ArticleList'})
      }
    }
  }
</script>
