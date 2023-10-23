<template>
  <div class="flex items-center gap-3 cursor-pointer hover:bg-slate-100 transition-all py-1 px-2">
    <img :src="'src/assets/img/' + img" class="w-4" />
    <div><slot></slot></div>
</div>
</template>
<script>
export default {
  props: ["img"]
};
</script>
