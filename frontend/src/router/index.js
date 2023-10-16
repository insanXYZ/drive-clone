import { createRouter, createWebHistory } from 'vue-router'
import homeView from '../views/homeView.vue'
import loginView from '../views/loginView.vue'
import registerView from '../views/registerView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      component: homeView
    },
    {
      path: '/login',
      component: loginView
    },
    {
      path : '/register',
      component: registerView
    }
  ]
})

export default router
