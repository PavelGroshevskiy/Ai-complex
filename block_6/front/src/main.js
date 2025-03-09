import './assets/main.css'

import { createApp, markRaw } from 'vue'
import { createPinia } from 'pinia'
import components from './shared/ui'
import App from './App.vue'
import router from '@/app/providers/router/router'

const pinia = createPinia()
pinia.use(({ store }) => {
  store.router = markRaw(router)
})
const app = createApp(App)

components.forEach((component) => {
  app.component(component.name, component)
})
app.use(pinia)
app.use(router).mount('#app')
