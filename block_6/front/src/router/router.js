import Main from '@/pages/Main.vue'
import Posts from '@/pages/Posts.vue'
import { createRouter, createMemoryHistory } from 'vue-router'

const routes = [
  { path: '/', component: Main },
  { path: '/about', component: Posts },
]

const router = createRouter({
  history: createMemoryHistory(),
  routes,
})
export default router
