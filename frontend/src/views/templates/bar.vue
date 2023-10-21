<template>
  <!-- flex -->
  <modalProgress v-if="showProgress" :value="value"></modalProgress>
  <div class="w-screen h-screen flex bg-zinc-200">
    <!-- leftbar -->
    <div class="flex w-[270px] flex-col gap-6 h-full px-5 py-3">
      <div class="flex gap-2 items-center">
        <img class="w-10" src="/src/assets/img/drive.png" />
        <span class="text-2xl font-light">Drive</span>
      </div>
      <!-- input -->
      <inputFile @uploadInput="(item) => upload(item)"></inputFile>
      <div class="flex flex-col gap-4 w-full">
        <menuLabel to="/" image="/src/assets/img/storage.png"
          >Drive saya</menuLabel
        >
        <menuLabel to="#" image="/src/assets/img/clock.png">Terbaru</menuLabel>
        <menuLabel to="#" image="/src/assets/img/trash.png">Sampah</menuLabel>
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
import input from "../../methods/files/input";
import inputFile from "../../components/app/inputFile.vue";
import modalProgress from "../../components/app/modalProgress.vue";

export default {
  data(){
    return{
      showProgress: false,
      value: 0
    }
  },
  components: {
    menuLabel,
    inputFile,
    modalProgress,
  },
  methods: {
    upload(item) {
      let formdata = new FormData();

      for (let i = 0; i < item.length; i++) {
        formdata.append("file[]", item[i]);
      }

      this.showProgress = true;

      input(formdata, (progressEvent) => {
        const { loaded, total } = progressEvent;
        let percent = Math.floor((loaded * 100) / total);
        if (percent <= 100) {
          this.value = percent
        }
      })
        .then((response) => {
          if(response.data.success == true){
            this.showProgress = false
          }
        })
        .catch((error) => {
          //
        });
    },
  },
};
</script>
