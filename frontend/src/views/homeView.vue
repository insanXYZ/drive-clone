<template>
  <bar>
    <div class="w-full flex flex-col">
      <div class="grid lg:grid-cols-4 md:grid-cols-3 gap-3">
        <div v-for="item in files.slice(0, windowWidth)" class="w-full overflow-hidden rounded-md h-[175px] flex flex-col gap-3 bg-zinc-100 px-2 py-4">
          <div class="flex gap-5 items-center px-2">
            <img v-if="item.type == 'image'" src="src/assets/img/image.png" class="w-5">
            <img v-else src="src/assets/img/doc.png" class="w-5">
            <div class="truncate text-sm">{{ item.fileName }}</div>
          </div>
          <img v-if="item.url" :src="item.url" class="w-full h-[115px] object-cover rounded-md">
          <div v-else class="w-full h-[115px] flex justify-center items-center bg-white rounded-md">
            <img src="src/assets/img/folder.png" class="w-14">
          </div>
        </div>
        <div v-if="files.length > 4" v-for="item in files.slice(4 , files.length)">
          {{ item.fileName }}
        </div>
      </div>
    </div>
  </bar>
</template>
<script>
import bar from "./templates/bar.vue";
import get from "../methods/files/get";

export default {
  data() {
    return {
      files : [],
      windowWidth : window.innerWidth > 1024 ? 4 : 3,
    };
  },
  mounted() {
    this.$nextTick(() => {
      window.addEventListener('resize', this.onResize);
    })
  },
  methods: {  
    onResize() {
      this.windowWidth = window.innerWidth > 1024 ? 4 : 3 
    },
  },
  components: {
    bar,
  },
  created() {
    get().then((response) => {
      this.files = response.data.data
    }).catch((response)=>{
      console.log(response);
    })
  },
};
</script>
