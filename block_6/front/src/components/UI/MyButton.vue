<template>
  <button class="my-btn">
    <slot></slot>
  </button>
</template>

<script>
export default {
  name: 'my-button',
}
</script>

<style lang="scss" scoped>
.my-btn {
  margin-top: 10px;
  padding: 9px 14px;
  color: rgb(179, 162, 162);
  border: 1px solid black;
}
</style>
