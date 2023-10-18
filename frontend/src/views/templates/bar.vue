<template>
  <!-- flex -->
  <div class="w-screen h-screen flex bg-zinc-200">
    <!-- leftbar -->
    <div class="flex w-[270px] flex-col gap-6 h-full px-5 py-3">
      <div class="flex gap-2 items-center">
        <img class="w-10" src="/src/assets/img/drive.png" />
        <span class="text-2xl font-light">Drive</span>
      </div>
      <div
        class="flex justify-center items-center py-3 shadow-lg gap-2 w-[100px] rounded-lg bg-white"
      >
        <img src="src/assets/img/plus.png" class="w-5" />
        <span>Baru</span>
      </div>
      <div class="flex flex-col gap-4 w-full">
        <menuLabel to="/" image="/src/assets/img/storage.png"
          >Drive saya</menuLabel
        >
        <menuLabel to="/recent" image="/src/assets/img/clock.png"
          >Terbaru</menuLabel
        >
        <menuLabel to="/trash" image="/src/assets/img/trash.png"
          >Sampah</menuLabel
        >
      </div>
    </div>
    <!-- rightbar -->
    <div class="w-full h-full overflow-hidden">
      <!-- topbar -->
      <div class="w-full px-1 pr-5 flex justify-between h-[50px]">
        <form action="" @submit.prevent class="flex items-center">
          <img
            src="src/assets/img/search.png"
            class="w-8 bg-white p-2 border-white rounded-l-full"
          />
          <input
            type="text"
            class="p-1 w-[350px] rounded-r-full focus:border-none focus:outline-none"
          />
          <input type="submit" class="hidden" />
        </form>
        <div class="flex gap-5 items-center">
          <img src="src/assets/img/setting.png" class="w-5" />
          <img src="src/assets/img/user.png" class="w-5" />
        </div>
      </div>
      <!-- mainBar -->
      <div
        class="bg-white w-[calc(100%-10px)] h-[calc(100%-55px)] box-border m-auto rounded-lg p-2 overflow-auto"
      >
        <slot></slot>
      </div>
    </div>
  </div>
</template>
<script>
import menuLabel from "../../components/app/menuLabel.vue";

export default {
  components: {
    menuLabel,
  },
};
</script>
