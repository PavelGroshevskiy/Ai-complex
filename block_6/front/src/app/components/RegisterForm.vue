<template>
  <div>
    <form @submit.prevent action="post">
      <my-input v-model="user.name" class="input" placeholder="name" />
      <my-input v-model="user.email" class="input" placeholder="email" />
      <my-input v-model="user.nickname" class="input" placeholder="nickname" />
      <my-input v-model="user.password" class="input" placeholder="password" />
      <my-input
        v-model="user.password_confirmation"
        class="input"
        placeholder="password_confirmation"
      />
      <div v-if="errors.length">
        <div v-for="error in errors">
          <li>
            {{ error }}
          </li>
        </div>
      </div>
      <my-button @click="register" class="btn-register">Register</my-button>
    </form>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      user: {
        name: '',
        password: '',
        nickname: '',
        email: '',
      },
      errors: [],
    }
  },
  methods: {
    register() {
      axios({
        method: 'POST',
        url: 'http://localhost/api/v1/register',
        data: {
          name: this.user.name,
          password: this.user.password,
          password_confirmation: this.user.password_confirmation,
          email: this.user.email,
          nickname: this.user.nickname,
        },
        headers: {
          Accept: 'application/json',
          'Content-Type': 'application/json',
          // 'Access-Control-Allow-Origin': 'http://localhost:5173',
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
