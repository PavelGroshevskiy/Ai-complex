<template>
  <div>
    <h3>List of Post</h3>
    <post-item :post v-for="post in posts" :key="post.id" />
  </div>
</template>

<script>
import PostItem from './PostItem.vue'
export default {
  components: {
    PostItem,
  },
  props: {
    posts: {
      type: Array,
      required: true,
    },
  },
}
</script>

<style lang="scss" scoped></style>
