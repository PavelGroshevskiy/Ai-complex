<template>
  <div>
    <h1>Posts</h1>

    <my-button @click="showDialog">Create Post</my-button>
    <my-dialog v-model:show="dialogVisible">
      <post-form />
    </my-dialog>
    <post-list :posts="posts.data" v-if="!isPostsLoading" />
    <div v-else>Loading...</div>
    <p v-if="error">
      {{ $router.push('/login') }}
    </p>
  </div>
</template>

<script>
import PostList from '@/app/components/PostList.vue'
import PostForm from '@/app/components/PostForm.vue'
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
    const { posts, isPostsLoading, error } = fetchData()
    return {
      posts,
      isPostsLoading,
      error,
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
