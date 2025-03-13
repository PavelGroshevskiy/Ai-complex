<template>
  <div>
    <h1>Register</h1>

    <register-form-options :errors="errors" @register="(user) => loginAuth('register', user)" />
  </div>
</template>

<script setup>
import RegisterFormOptions from '@/app/components/RegisterFormOptions.vue'
import { useAuthStore } from '@/app/store/auth'
import { storeToRefs } from 'pinia'

const { loginAuth } = useAuthStore()
const { errors } = storeToRefs(useAuthStore())
</script>

<style lang="scss" scoped></style>
