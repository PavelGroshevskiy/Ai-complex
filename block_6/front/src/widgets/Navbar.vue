<template>
  <nav class="navbar">
    <div>
      <form @submit.prevent="authStore.logout" style="margin: 10px">
        <my-button>Logout</my-button>
      </form>
    </div>
    <div v-if="authStore.user">User : {{ authStore.user.name }}</div>
    <div class="navbar__btns">
      <my-button @click="$router.push({ name: 'main' })">Посты</my-button>
      <my-button style="margin-left: 20px" @click="$router.push({ name: 'login' })"
        >Login
      </my-button>
      <my-button style="margin-left: 20px" @click="$router.push({ name: 'register' })"
        >Register
      </my-button>

      <my-button style="margin-left: 20px" @click="$router.push({ name: 'options_register' })"
        >RegisterOptionsApi
      </my-button>
    </div>
  </nav>
</template>

<script>
import { useAuthStore } from '@/app/store/auth'
import MyButton from '../shared/ui/MyButton.vue'

export default {
  data() {
    return {
      MyButton,
      user: null,
    }
  },
  methods: {
    async getUser() {
      if (localStorage.getItem('token')) {
        const res = await fetch('http://localhost/api/v1/users', {
          headers: {
            authorization: `Bearer ${localStorage.getItem('token')}`,
          },
        })
        const data = await res.json()
        if (res.ok) {
          this.user = data
        }
      }
    },
  },
  setup() {
    const authStore = useAuthStore()

    return {
      authStore,
    }
  },
  mounted() {
    this.authStore.getAuthUser()
  },
}
</script>

<style scoped>
.navbar {
  height: 50px;
  background-color: lightgray;
  box-shadow: 2px 2px 4px gray;
  display: flex;
  align-items: center;
  padding: 0 15px;
}
.navbar__btns {
  margin-left: auto;
}
</style>
