import Vue from 'vue'
import Router from 'vue-router'
import Index from '@/page/index/index.vue'
import News from '@/page/news/detail.vue'
import Project from '@/page/project/detail.vue'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Index',
      component: Index
    },
    {
      path: '/news',
      name: 'News',
      component: News
    },
    {
      path: '/Project',
      name: 'Project',
      component: Project
    }
  ]
})
