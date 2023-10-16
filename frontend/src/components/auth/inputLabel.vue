<template>
  <div class="flex flex-col gap-2">
    <label :for="label" class="text-sm">{{ label }}</label>
    <input :type="type" class="border p-1 focus:outline-none text-sm" />
  </div>
</template>
<script>
export default {
  props: ["label", "type"],
};
</script>
