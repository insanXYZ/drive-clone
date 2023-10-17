<template>
  <div class="flex flex-col gap-2">
    <label :for="label" class="text-sm">{{ label }}</label>
    <input
      :type="type"
      class="border p-1 focus:outline-none text-sm"
      v-model="input"
    />
  </div>
</template>
<script>
export default {
  data() {
    return {
      input: "",
    };
  },
  props: ["label", "type"],
  emits: ["input"],
  watch: {
    input() {
      this.$emit("input", this.input);
    },
  },
};
</script>
