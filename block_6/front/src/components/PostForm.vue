<template>
  <div>
    <h2>Create Post</h2>
    <form @submit.prevent action="post">
      <my-input v-model="post.title" class="input" placeholder="title" />
      <my-input v-model="post.description" class="input" placeholder="description" />
      <div v-if="errors.length">
        <div v-for="error in errors">
          <li>
            {{ error }}
          </li>
        </div>
      </div>
      <my-button :disabled="isFormValid" @click="createPost" class="btn-create">Create</my-button>
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
      errors: [],
    }
  },
  methods: {
    createPost() {
      this.errors = []

      if (!this.post.title) {
        this.errors.push('Title is required')
      }
      if (!this.post.description) {
        this.errors.push('Description is required')
      }
      if (!this.errors.length) {
        this.post.id = Date.now()
        this.$emit('create', this.post)
        this.post = {
          title: '',
          description: '',
        }
      }
    },
  },
  watch: {},
  computed: {
    isFormValid() {
      this.errors = []
      const notEmpty = this.post.description != '' && this.post.title != ''
      if (notEmpty) {
        return true
      } else {
        this.errors.push('Fields required')
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
