<template>
  <div>
    <navbar />
    <slot></slot>
  </div>
</template>

<script>
import Navbar from '@/widgets/Navbar.vue'

export default {
  components: {
    Navbar,
  },
}
</script>

<style lang="scss" scoped></style>
