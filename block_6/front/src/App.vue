<template>
  <div>
    <layout>
      <router-view />
    </layout>
  </div>
</template>

<script>
import Layout from '@/app/providers/Layout.vue'

export default {
  components: {
    Layout,
  },
}
</script>

<style lang="scss" scoped></style>
