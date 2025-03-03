<template>
  <div>
    <h2>Create Post</h2>
    <form @submit.prevent action="post">
      <my-input v-model="post.title" class="input" placeholder="title" />
      <my-input v-model="post.description" class="input" placeholder="description" />
      <p v-if="responseFromServ">{{ responseFromServ }}</p>
      <div v-if="errors.length">
        <div v-for="error in errors">
          <li>
            {{ error }}
          </li>
        </div>
      </div>
      <my-button @click="createPost" class="btn-create">Create</my-button>
    </form>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  data() {
    return {
      post: {
        title: '',
        description: '',
      },
      responseFromServ: '',
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
      // if (!this.errors.length) {
      axios({
        method: 'post',
        url: 'http://localhost/api/v1/user/posts',
        data: {
          title: this.post.title,
          description: this.post.description,
          user_id: 1,
          author: 'Leon',
        },
        headers: {
          Accept: 'application/json',
          'Content-Type': 'application/json',
          'Access-Control-Allow-Origin': 'http://localhost:5173',
        },
      })
        .then(function (response) {
          console.log(response.data)
          console.log(response.statusText)
          // this.responseFromServ = response.data
        })
        .catch((error) => {
          if (error.response && error.response.status === 403) {
            this.responseFromServ = error.response
            console.error('Доступ запрещен из-за CORS')
          } else if (error.response && error.response.status === 422) {
            console.error('Ошибки валидации:', error.response.data.errors)
          } else {
            console.error('Произошла ошибка:', error)
          }
        })
      // }
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
