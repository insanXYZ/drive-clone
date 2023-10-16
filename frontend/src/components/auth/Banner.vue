<template>
  <div
    class="bg-zinc-100 rounded-r-md flex flex-col gap-4 items-center justify-center"
  >
    <div class="flex items-center gap-4">
      <div class="text-4xl font-semibold">{{ header }}</div>
      <div class="w-[1px] h-[40px] bg-black rounded-2xl"></div>
      <div class="flex items-center gap-2">
        <img src="src/assets/img/drive.png" class="w-8" />
        <span class="text-xl">Drive</span>
      </div>
    </div>
    <div class="flex items-center gap-2">
      <div>
        <span>{{ text }}</span>
        <router-link :to="to" class="text-blue-500 font-semibold">{{
          anch
        }}</router-link>
      </div>
      <div class="flex items-center gap-2"></div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["header", "text", "to", "anch"],
};
</script>
