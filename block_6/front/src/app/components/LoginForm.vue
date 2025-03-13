<template>
  <div>
    <form @submit.prevent="auth" action="post">
      <my-input v-model="user.email" class="input" placeholder="email" />
      <p class="error" v-if="errors.email">{{ errors.email[0] }}</p>
      <my-input v-model="user.password" class="input" placeholder="password" />
      <p class="error" v-if="errors.password">{{ errors.password[0] }}</p>
      <div v-if="errors.message">
        {{ console.log(errors) }}
        {{ errors.message[0] }}
      </div>
      <my-button class="btn-login">Login</my-button>
    </form>
  </div>
</template>

<script>
export default {
  props: {
    errors: {
      type: Object,
    },
  },
  data() {
    return {
      user: {
        email: '.com',
        password: '123456',
      },
    }
  },
  methods: {
    auth() {
      this.$emit('auth', this.user)
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
.error {
  color: red;
}

.btn-login {
  align-self: flex-end;
}
</style>
