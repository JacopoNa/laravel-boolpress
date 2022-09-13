<template>
    <div class="container">
        <h2>Tutti i post</h2>

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

        <nav aria-label="Page navigation example">
            <ul class="pagination mt-3">
                <li class="page-item" :class="{'disabled' : currentPage == 1}">
                    <a @click.prevent="getPostFromAxios(currentPage - 1)" class="page-link" href="#">Previous</a>
                </li>

                <li v-for="pageNumber in lastPage" :key="pageNumber" class="page-item" :class="{'active' : pageNumber == currentPage}">
                    <a class="page-link" href="#" @click.prevent="getPostFromAxios(pageNumber)">
                        {{ pageNumber }}
                    </a>
                </li> 

                <li class="page-item" :class="{'disabled' : currentPage ==  lastPage}">
                    <a @click.prevent="getPostFromAxios(currentPage + 1)" class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
export default {
    name: 'Posts',
    data() {
        return {
            posts: [],
            currentPage: 1,
            lastPage: null
        };
    },
    methods: {
        getPostFromAxios(param) {
            axios.get('http://127.0.0.1:8000/api/posts?page=' + param)
            .then((response) => {
                this.posts = response.data.results.data;
                this.currentPage = response.data.results.current_page,
                this.lastPage = response.data.results.last_page
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
        this.getPostFromAxios(1)
    }
}
</script>