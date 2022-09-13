import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import HomePage from './pages/HomePage.vue';
import About from './pages/About.vue';
import Blog from './pages/Blog.vue';
import NotFoundPage from './pages/NotFoundPage.vue';

const router = new VueRouter({
    mode: 'history',
    routes: [
        { 
            path: '/', 
            name: 'home',
            component: HomePage 
        },
        { 
            path: '/about', 
            name: 'about',
            component: About 
        },
        { 
            path: '/blog', 
            name: 'blog',
            component: Blog 
        },
        { 
            path: '/*', 
            name: 'not-found-page',
            component: NotFoundPage 
        }
      ]
  });

  export default router;