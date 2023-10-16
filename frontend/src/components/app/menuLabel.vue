<template>
  <router-link
    :to="to"
    class="flex gap-5 items-center transition-all hover:bg-blue-200 px-2 py-1 rounded-full"
  >
    <img :src="image" class="w-4" />
    <span> <slot></slot> </span>
  </router-link>
</template>
<script>
export default {
  props: ["image", "to"],
};
</script>
