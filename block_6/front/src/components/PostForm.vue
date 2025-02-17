<template>
  <div>
    <h2>Create Post</h2>
    <form @submit.prevent action="post">
      <my-input v-model="post.title" class="input" placeholder="title" />
      <my-input v-model="post.description" class="input" placeholder="description" />
      <my-button @click="createPost" class="btn-create">Create</my-button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      post: {
        title: '',
        description: '',
      },
    }
  },
  methods: {
    createPost() {
      this.post.id = Date.now()
      this.$emit('create', this.post)
      this.post = {
        title: '',
        description: '',
      }
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

.btn-create {
  align-self: flex-end;
}
</style>
