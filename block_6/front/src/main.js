import './assets/main.css'

import { createApp } from 'vue'
import components from './shared/ui'
import App from './App.vue'
import router from '@/app/providers/router/router'

const app = createApp(App)

components.forEach((component) => {
  app.component(component.name, component)
})

app.use(router).mount('#app')
