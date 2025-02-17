<template>
  <div>
    <h1>Posts</h1>
    <my-button @click="showDialog">Create Post</my-button>
    <my-dialog v-model:show="dialogVisible">
      <post-form @create="createPost" />
    </my-dialog>
    <post-list :posts="posts" v-if="!isPostsLoading" />
    <div v-else>Loading...</div>
  </div>
</template>

<script>
import PostList from './components/PostList.vue'
import PostForm from './components/PostForm.vue'
import axios from 'axios'
export default {
  components: {
    PostList,
    PostForm,
  },
  data() {
    return {
      posts: [],
      dialogVisible: false,
      isPostsLoading: false,
    }
  },
  methods: {
    createPost(post) {
      this.posts.push(post)
      this.dialogVisible = false
    },
    showDialog() {
      this.dialogVisible = true
    },
    async fetchPosts() {
      this.isPostsLoading = true
      try {
        setTimeout(async () => {
          const response = await axios.get('http://localhost/api/v1/posts')
          this.posts = response.data
          this.isPostsLoading = false
        }, 2000)
      } catch (error) {
        console.log(error)
      }
    },
  },
  mounted() {
    this.fetchPosts()
  },
}
</script>

<style lang="scss" scoped>
form {
  display: flex;
  flex-direction: column;
}

.btn-create {
  padding: 9px;
  margin-top: 5px;
  align-self: flex-end;
}
</style>
