<template>
  <div>
    <form @submit.prevent action="post">
      <my-input v-model="user.name" class="input" placeholder="name" />
      <p v-if="errors.name">{{ errors.name[0] }}</p>
      <my-input v-model="user.email" class="input" placeholder="email" />
      <p v-if="errors.email">{{ errors.email[0] }}</p>
      <my-input v-model="user.nickname" class="input" placeholder="nickname" />
      <p v-if="errors.nickname">{{ errors.nickname[0] }}</p>
      <my-input v-model="user.password" class="input" placeholder="password" />
      <p v-if="errors.password">{{ errors.password[0] }}</p>
      <my-input
        v-model="user.password_confirmation"
        class="input"
        placeholder="password_confirmation"
      />

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
      errors: {},
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
        },
      })
        .then((response) => {
          localStorage.setItem('token', response.data.token)
          this.$router.push('/')
        })
        .catch((error) => {
          if (error.response && error.response.status === 403) {
            console.error('Доступ запрещен из-за CORS')
          } else {
            this.errors = error.response.data.errors
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
