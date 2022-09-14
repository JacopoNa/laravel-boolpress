<template>
    <div class="card mt-3">
        <!-- <img src="..." class="card-img-top" alt="..."> -->
        <div class="card-body">
            <h5 class="card-title">{{ post.title }}</h5>
            <p class="card-text">{{ cutText(post.content) }}</p>
            <router-link class="btn btn-primary" :to="{name: 'single-post', params: {slug: post.slug}}">Dettagli</router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: 'PostDetails',
    props: {
        post: Object
    },
    methods: {
        cutText(text) {
            if (text.length > 70) {
                return text.slice(0, 70) + '...';
            } else {
                return text;
            }
        }
    }
}
</script>