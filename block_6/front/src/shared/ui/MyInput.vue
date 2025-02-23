<template>
  <input :value="modelValue" @input="updateInput" class="input" type="text" />
</template>

<script>
export default {
  name: 'my-input',
  props: {
    modelValue: {
      type: [String, Number],
    },
  },
  methods: {
    updateInput(e) {
      this.$emit('update:modelValue', e.target.value)
    },
  },
}
</script>

<style lang="scss" scoped>
.input {
  padding: 10px;
  margin-top: 10px;
}
</style>
