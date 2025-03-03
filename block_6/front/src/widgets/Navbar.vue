<template>
  <nav class="navbar">
    <div @click="$router.push('/')">Vue 3</div>
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
export default {}
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
