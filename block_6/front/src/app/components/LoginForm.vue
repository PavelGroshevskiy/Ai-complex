<template>
  <div>
    <form @submit.prevent action="post">
      <my-input v-model="user.email" class="input" placeholder="email" />
      <my-input v-model="user.password" class="input" placeholder="password" />
      <div v-if="errors.length">
        <div v-for="error in errors">
          <li>
            {{ error }}
          </li>
        </div>
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
        email: 'admin@.mail.com',
        password: 'admin',
      },
      errors: [],
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
          'Access-Control-Allow-Origin': 'http://localhost:5173',
        },
      }).catch((error) => {
        if (error.response && error.response.status === 403) {
          console.error('Доступ запрещен из-за CORS')
        } else {
          console.error('Произошла ошибка:', error)
        }
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
