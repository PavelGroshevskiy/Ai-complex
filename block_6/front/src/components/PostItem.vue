<template>
  <div class="post">
    <div>
      <div>
        {{ post.id }}
      </div>
      <div>
        {{ post.title }}
      </div>
      <div>
        {{ post.description }}
      </div>
    </div>
    <div class="post_btns">
      <my-button class="btn">Delete</my-button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    post: {
      type: Object,
      required: true,
    },
  },
}
</script>

<style lang="scss" scoped>
.post {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 15px;
  border: 2px solid black;
  border-radius: 15px;
  margin-top: 15px;
}
</style>
