<template>
  <div>
    <form @submit.prevent="() => auth('register', formData)" action="post">
      <my-input v-model="formData.name" class="input" placeholder="name" />
      <p class="error" v-if="errors.name">{{ errors.name[0] }}</p>

      <my-input v-model="formData.email" class="input" placeholder="email" />
      <p class="error" v-if="errors.email">{{ errors.email[0] }}</p>

      <my-input v-model="formData.nickname" class="input" placeholder="nickname" />
      <p class="error" v-if="errors.nickname">{{ errors.nickname[0] }}</p>

      <my-input v-model="formData.password" class="input" placeholder="password" />
      <p class="error" v-if="errors.password">{{ errors.password[0] }}</p>

      <my-input
        v-model="formData.password_confirmation"
        class="input"
        placeholder="password_confirmation"
      />

      <my-button class="btn-register">Register</my-button>
    </form>
  </div>
</template>

<script setup>
import { reactive } from 'vue'
import { useAuthStore } from '../store/auth'
import { storeToRefs } from 'pinia'

const { auth } = useAuthStore()
const { errors } = storeToRefs(useAuthStore())

const formData = reactive({
  name: '',
  password: '',
  nickname: '',
  email: '',
  password_confirmation: '',
})
</script>

<style lang="scss" scoped>
form {
  display: flex;
  flex-direction: column;
}

.error {
  color: red;
}
</style>
