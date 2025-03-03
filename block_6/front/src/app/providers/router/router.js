import Login from '@/pages/Login.vue'
import Main from '@/pages/Main.vue'
import Posts from '@/pages/Posts.vue'
import Register from '@/pages/Register.vue'
import { createRouter, createMemoryHistory } from 'vue-router'

const routes = [
  { path: '/', component: Main },
  { path: '/about', component: Posts },
  { path: '/login', component: Login },
  { path: '/register', component: Register },
]

const router = createRouter({
  history: createMemoryHistory(),
  routes,
})
export default router
