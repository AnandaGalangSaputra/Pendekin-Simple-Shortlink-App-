import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import ListLink from '../views/ListLink.vue'
import RedirectView from '../views/RedirectView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/ListLink',
      name: 'ListLink',
      component: ListLink,
    },
    { path: '/:short',
      name: 'redirect',
      component: RedirectView 
    }
  ],
})

export default router
