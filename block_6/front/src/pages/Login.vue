<template>
  <div>
    <h1>Login</h1>
    <login-form @auth="authUser" :errors="errors" />
  </div>
</template>

<script>
import LoginForm from '@/app/components/LoginForm.vue'
import { useAuthStore } from '@/app/store/auth'
import { storeToRefs } from 'pinia'

export default {
  components: {
    LoginForm,
  },

  setup() {
    const { loginAuth } = useAuthStore()
    const { errors } = storeToRefs(useAuthStore())
    return { loginAuth, errors }
  },
  methods: {
    authUser(user) {
      this.loginAuth('login', user)
    },
  },
}
</script>

<style lang="scss" scoped></style>
