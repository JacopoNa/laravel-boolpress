<template>
    <div class="container">
        <div v-if="post">
            <h1>{{ post.title }}</h1>
        </div>

        <img v-if="post.cover" :src="post.cover" :alt="post.title" class="w-50">

        <h3 v-if="post.category">Categoria: {{ post.category.name }}</h3>
        <div v-if="post.tags.length > 0">
            <h5 v-for="tag,index in post.tags" :key="index">{{ tag.name }}</h5>
        </div>

        <p>{{ post.content }}</p>
    </div>
</template>

<script>
export default {
    name: 'SinglePost',
    data() {
        return {
            post: null
        }
    },
    mounted() {
        axios.get('http://127.0.0.1:8000/api/posts/' + this.$route.params.slug)
        .then((response) => {
            if(response.data.success) {
                this.post = response.data.results;
            } else {
                this.$router.push({name: 'not-found-page'});
            }
        });
    }
}
</script>