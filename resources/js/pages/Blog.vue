<template>
    <div>
        <h1>Blog</h1>

        <Posts/>
    </div>
</template>

<script>
import Posts from '../components/Posts.vue';

export default {
    name: 'Blog',
    components: {
        Posts
    }
}
</script>

<style lang="scss" scoped>
h1 {
    text-align: center;
}
</style>