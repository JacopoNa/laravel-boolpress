<template>
    <div class="container">
        <h2>Tutti i post</h2>

        <div class="row row-cols-3">
            <div class="col" v-for="singlePost in posts" :key="singlePost.id">
                <PostDetails :post ="singlePost"/>
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
import PostDetails from './PostDetails.vue';

export default {
    name: 'Posts',
    components: {
        PostDetails
    },
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
        }
    },
    mounted() {
        this.getPostFromAxios(1)
    }
}
</script>