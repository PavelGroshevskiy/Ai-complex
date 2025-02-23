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
import PostList from '@/components/PostList.vue'
import PostForm from '@/components/PostForm.vue'
import { fetchData } from '@/shared/lib/fetchData'

export default {
  components: {
    PostList,
    PostForm,
  },
  data() {
    return {
      dialogVisible: false,
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
  },
  watch: {
    dialogVisible(value) {
      console.log(value)
    },
  },
  setup() {
    const { posts, isPostsLoading } = fetchData()
    return {
      posts,
      isPostsLoading,
    }
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
