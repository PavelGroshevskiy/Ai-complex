<template>
  <nav class="navbar">
    <span v-if="user">User : {{ user.name }}</span>
    <div class="navbar__btns">
      <my-button @click="$router.push('/')">Посты</my-button>
      <my-button style="margin-left: 20px" @click="$router.push('/about')">О сайте</my-button>
      <my-button style="margin-left: 20px" @click="$router.push('/login')">Login</my-button>
      <my-button style="margin-left: 20px" @click="$router.push('/register')">Register</my-button>
      <my-button style="margin-left: 20px">Logout</my-button>
    </div>
  </nav>
</template>

<script>
export default {
  data() {
    return {
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
  mounted() {
    this.getUser()
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
