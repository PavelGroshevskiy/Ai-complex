<template>
  <div>
    <form @submit.prevent action="post">
      <my-input v-model="user.email" class="input" placeholder="email" />
      <p v-if="errors.email">{{ errors.email[0] }}</p>
      <my-input v-model="user.password" class="input" placeholder="password" />
      <p v-if="errors.password">{{ errors.password[0] }}</p>
      <div v-if="errors.message">
        {{ console.log(errors) }}
        {{ errors.message[0] }}
      </div>
      <my-button @click="login" class="btn-login">Login</my-button>
    </form>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      user: {
        email: '.com',
        password: '123456',
      },
      errors: {},
    }
  },
  methods: {
    login() {
      axios({
        method: 'POST',
        url: 'http://localhost/api/v1/login',
        data: {
          email: this.user.email,
          password: this.user.password,
        },
        headers: {
          Accept: 'application/json',
          'Content-Type': 'application/json',
        },
      })
        .then((response) => {
          localStorage.setItem('token', response.data.token)
          this.$router.push('/')
        })
        .catch((error) => {
          console.error('Произошла ошибка:', error)
          this.errors = error.response.data.errors

          console.log(error)
        })
    },
  },
}
</script>

<style lang="scss" scoped>
form {
  display: flex;
  flex-direction: column;
}

.input {
  padding: 10px;
  margin-top: 10px;
}

.btn-login {
  align-self: flex-end;
}
</style>
