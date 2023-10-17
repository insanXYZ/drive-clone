<template>
  <form
    action=""
    @submit.prevent="store"
    class="flex flex-col justify-center gap-3 px-5 py-3"
  >
    <slot></slot>
    <hr />
    <button type="submit" class="bg-green-300 text-white py-1">
      {{ button }}
    </button>
  </form>
</template>
<script>
export default {
  props: ["button"],
  emits: ["submit"],
  methods: {
    store() {
      this.$emit("submit");
    },
  },
};
</script>
