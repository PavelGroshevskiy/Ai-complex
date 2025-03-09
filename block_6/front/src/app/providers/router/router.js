import Login from '@/pages/Login.vue'
import Main from '@/pages/Main.vue'
import Register from '@/pages/Register.vue'
import RegisterOptionsApi from '@/pages/RegisterOptionsApi.vue'
import { createRouter, createMemoryHistory } from 'vue-router'

const routes = [
  { path: '/', name: 'main', component: Main },
  { path: '/login', name: 'login', component: Login },
  { path: '/register', name: 'register', component: Register },
  { path: '/options_register', name: 'options_register', component: RegisterOptionsApi },
]

const router = createRouter({
  history: createMemoryHistory(),
  routes,
})
export default router
