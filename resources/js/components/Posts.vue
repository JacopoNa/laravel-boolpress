<template>
    <div class="container">
        <h1>Tutti i post</h1>

        <div class="row row-cols-3">
            <div class="col" v-for="post in posts" :key="post.id">
                <div class="card mt-3">
                    <!-- <img src="..." class="card-img-top" alt="..."> -->
                    <div class="card-body">
                        <h5 class="card-title">{{ post.title }}</h5>
                        <p class="card-text">{{ cutText(post.content) }}</p>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Posts',
    data() {
        return {
            posts: []
        };
    },
    methods: {
        getAxios() {
            axios.get('http://127.0.0.1:8000/api/posts')
            .then((response) => {
                this.posts = response.data.results;
            })
        },
        cutText(text) {
            if (text.length > 70) {
                return text.slice(0, 70) + '...';
            } else {
                return text;
            }
        }
    },
    mounted() {
        this.getAxios()
    }
}
</script>