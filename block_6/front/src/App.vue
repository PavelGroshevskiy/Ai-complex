<template>
  <div>
    <layout>
      <router-view />
    </layout>
  </div>
</template>

<script>
import Navbar from '@/widgets/Navbar.vue'
import Layout from '@/app/providers/Layout.vue'

export default {
  components: {
    Navbar,
    Layout,
  },
}
</script>

<style lang="scss" scoped></style>
