import { createRouter, createWebHistory } from 'vue-router'
import homeView from '../views/homeView.vue'
import loginView from '../views/loginView.vue'
import registerView from '../views/registerView.vue'
import isAuth from "../guards/isAuth"
import isGuest from "../guards/isGuest"
import trashView from "../views/trashView.vue"
import starred from "../views/starredView.vue"

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      component: homeView,
      beforeEnter: isAuth
    },
    {
      path: '/trash',
      component: trashView,
      beforeEnter: isAuth
    },
    {
      path: '/starred',
      component: starredView,
      beforeEnter: isAuth
    },
    {
      path: '/login',
      component: loginView,
      beforeEnter: isGuest
    },
    {
      path : '/register',
      component: registerView,
      beforeEnter: isGuest
    }
  ]
})

export default router
